<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInvoiceRequest;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Customer;
use App\Models\AccountName;
use App\Models\AccountType;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\State;
use App\Models\Term;
use App\Models\Group;
use App\Models\Product;
use App\Models\Company;
use App\Models\TermsAndcondition;
use Gate;
use PDF;
use Illuminate\Http\Request;
use App\Models\Country;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InvoicesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Invoice::with(['customer', 'place_of_supply', 'team'])->where('team_id',auth()->user()->team->id)->select(sprintf('%s.*', (new Invoice())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'invoice_show';
                $editGate = 'invoice_edit';
                $deleteGate = 'invoice_delete';
                $crudRoutePart = 'invoices';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('type', function ($row) {
                return $row->type ? Invoice::TYPE_RADIO[$row->type] : '';
            });

            $table->editColumn('invoice_no', function ($row) {
                return $row->invoice_no ? $row->invoice_no : '';
            });
            $table->addColumn('customer_first_name', function ($row) {
                return $row->customer ? $row->customer->first_name : '';
            });

            $table->editColumn('customer_email', function ($row) {
                return $row->customer_email ? $row->customer_email : '';
            });
            $table->editColumn('send_later', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->send_later ? 'checked' : null) . '>';
            });

            $table->addColumn('place_of_supply_state', function ($row) {
                return $row->place_of_supply ? $row->place_of_supply->state : '';
            });

            $table->editColumn('type_of_supply', function ($row) {
                return $row->type_of_supply ? Invoice::TYPE_OF_SUPPLY_SELECT[$row->type_of_supply] : '';
            });
            $table->editColumn('message_on_invoice', function ($row) {
                return $row->message_on_invoice ? $row->message_on_invoice : '';
            });
            $table->editColumn('message_on_statement', function ($row) {
                return $row->message_on_statement ? $row->message_on_statement : '';
            });
            $table->editColumn('discount_type', function ($row) {
                return $row->discount_type ? Invoice::DISCOUNT_TYPE_SELECT[$row->discount_type] : '';
            });
            $table->editColumn('discount_amount', function ($row) {
                return $row->discount_amount ? $row->discount_amount : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'customer', 'send_later', 'place_of_supply']);

            return $table->make(true);
        }

        return view('frontend.invoices.index');
    }

    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $place_of_supplies = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $groups = Group::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $terms = Term::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $account_types = AccountType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $account_names = AccountName::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categories = Category::pluck('name', 'id');
        $company = Company::where('team_id',auth()->user()->team->id)->first();
        $terms_and_conditions = TermsAndcondition::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('frontend.invoices.create', compact('customers', 'place_of_supplies','states','groups','terms','products','countries','account_names', 'account_types', 'categories','company','terms_and_conditions'));
    }

    public function store(StoreInvoiceRequest $request)
    {

        $invoice = Invoice::create($request->all());
        if(isset(auth()->user()->team))
        {
            $invoice->update(['team_id' => auth()->user()->team->id]);

        }
        for($i=0;$i<count($request->product_id);$i++)
        {
            $product[$i]['qty'] = $request->quantity[$i];
            $product[$i]['rate'] = $request->rate[$i];
            $product[$i]['amount'] = $request->amount_inv[$i];
            $product[$i]['tax'] = $request->tax_gst[$i];
            $product[$i]['invoice_id'] = $invoice->id;
            $product[$i]['product_id'] = $request->product_id[$i];
            if(isset(auth()->user()->team))
            {
                $product[$i]['team_id'] = auth()->user()->team->id;
            }
        }

        $invoice_detail  = InvoiceDetail::insert($product);

        return redirect()->route('frontend.invoices.index');
    }

    public function edit(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = Customer::pluck('first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $place_of_supplies = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');

        $invoice->load('customer', 'place_of_supply', 'team');

        return view('frontend.invoices.edit', compact('customers', 'invoice', 'place_of_supplies'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->all());

        return redirect()->route('frontend.invoices.index');
    }

    public function show(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->load('customer', 'place_of_supply', 'team', 'invoiceInvoiceDetails');

        return view('frontend.invoices.show', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        abort_if(Gate::denies('invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $invoice->delete();

        return back();
    }

    public function massDestroy(MassDestroyInvoiceRequest $request)
    {
        Invoice::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
    public function allInvoices(Request $request)
    {
        return view('frontend.invoices.all-invoices');
    }

    public function accept_invoice_request(Request $request)
    {
        $invoice_id = $request->invoice_id;
        $update_invoice = Invoice::where('id',$invoice_id)->update(['invoice_request' => 2]);
        $invoice = Invoice::where('id',$invoice_id)->first();
        return $invoice;

    }

    public function pdf(Request $request)
    {
        $invoice_id = $request->invoice;
        $total_amount = 0;
        $data['invoice'] = Invoice::with('customer')->where('id',$invoice_id)->where('team_id',auth()->user()->team->id)->first();
        $data['invoiceDetail'] = InvoiceDetail::with('product')->where('invoice_id',$invoice_id)->where('team_id',auth()->user()->team->id)->get();
        $data['customer'] = Customer::with('customerUserAddresses','city','state')->where('id',$invoice_id)->where('team_id',auth()->user()->team->id)->first();
        $data['company'] = Company::with(['city','state'])->where('team_id',auth()->user()->team->id)->first();
        foreach($data['invoiceDetail'] as $products)
        {
            $total_amount += $products->amount;
        }
        $data['total_amount'] = $total_amount;
        $data['amount_in_words'] = $this->getIndianCurrency($total_amount);
        $pdf = PDF::loadView('frontend.invoices.invoicePdf',$data)->setPaper('a4', 'portrait');
        return $pdf->stream('invoice_.pdf');


    }

    public function getIndianCurrency(int $number) {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            100000             => 'lakh',
            10000000          => 'crore'
        );

        if (!is_numeric($number)) {
            return false;
        }

        // if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        //     // overflow
        //     trigger_error(
        //         'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
        //         E_USER_WARNING
        //     );
        //     return false;
        // }

        if ($number < 0) {
            return $negative . $this->getIndianCurrency(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 100000:
                $thousands   = ((int) ($number / 1000));
                $remainder = $number % 1000;

                $thousands = $this->getIndianCurrency($thousands);

                $string .= $thousands . ' ' . $dictionary[1000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 10000000:
                $lakhs   = ((int) ($number / 100000));
                $remainder = $number % 100000;

                $lakhs = $this->getIndianCurrency($lakhs);

                $string = $lakhs . ' ' . $dictionary[100000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            case $number < 1000000000:
                $crores   = ((int) ($number / 10000000));
                $remainder = $number % 10000000;

                $crores = $this->getIndianCurrency($crores);

                $string = $crores . ' ' . $dictionary[10000000];
                if ($remainder) {
                    $string .= $separator . $this->getIndianCurrency($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = $this->getIndianCurrency($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= $this->getIndianCurrency($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }

}

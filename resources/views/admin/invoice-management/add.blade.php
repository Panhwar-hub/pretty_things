@extends('admin.dash_layouts.main')
@section('content')
@include('admin.dash_layouts.sidebar')
<style>
    section.invoice  .container-fluid {
    padding-left: 320px;
}
</style>
<form id="invoice-form">
<section class="invoice">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9">
                <div class="invoice-bg">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="add__your ">
                                <div class="logo__edit">
                                    <div class="main">
                                    <img src="" class="logo-img" alt="logo">
                                        <svg class="svg-inline--fa fa-plus" aria-hidden="true"
                                            focusable="false" data-prefix="fas" data-icon="plus" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M432 256c0 17.69-14.33 32.01-32 32.01H256v144c0 17.69-14.33 31.99-32 31.99s-32-14.3-32-31.99v-144H48c-17.67 0-32-14.32-32-32.01s14.33-31.99 32-31.99H192v-144c0-17.69 14.33-32.01 32-32.01s32 14.32 32 32.01v144h144C417.7 224 432 238.3 432 256z">
                                            </path>
                                        </svg><!-- <span class="fas fa-plus"></span> --> Add Your Logo</div>
                                </div>

                                <input type="file" onchange="logo(this);" name="img_path" accept="image/*" class="file-1" tabindex="12">


                            </div>
                            <div class="invoice_form">
                                <form>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <textarea name="company_name" id="" class="form-control"
                                                    placeholder="Who is this invoice from? (required)"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Bill To</label>
                                                <textarea name="bill_to" id="" class="form-control"
                                                    placeholder="Who is this invoice to? (required)"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ship to</label>
                                                <textarea name="ship_to" id="" class="form-control"
                                                    placeholder="(optional)"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="invoice-tittle">
                                <input class="form-control in-title" value="INVOICE">
                                <div class="invoice-subtitle">
                                    <div class="input-group">
                                        <span class="input-group-text">#</span>
                                        <input  name="invoice_no" class="form-control ng-pristine ng-untouched ng-valid" tabindex="11"
                                            ng-model="document.number">
                                    </div>
                                </div>
                            </div>

                            <div class="form-date">
                                <div class="input-group addon-input">
                                    <input name="date_lable" class="input-label form-control" value="Date">
                                    <div class="input-group-addon">
                                        <input name="date" class="form-control">
                                    </div>
                                </div>
                                <div class="input-group addon-input">
                                    <input name="payment_termlable" class="input-label form-control" value="Payment Terms">
                                    <div name="payment_term" class="input-group-addon">
                                        <input class="form-control">
                                    </div>
                                </div>
                                <div class="input-group addon-input">
                                    <input name="due_datelable" class="input-label form-control" value="Due Date">
                                    <div class="input-group-addon">
                                        <input name="due_date" class="form-control">
                                    </div>
                                </div>
                                <div class="input-group addon-input">
                                    <input name="po_lable" class="input-label form-control" value="PO Number">
                                    <div class="input-group-addon">
                                        <input name="po_no" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-items">
                        <div class="name">
                            <div class="field bordered">
                                <input class="input-label form-control" value="Item">
                            </div>
                        </div>
                        <div class="quantity">
                            <div class="field bordered">
                                <input class="input-label form-control" value="Quantity">
                            </div>
                        </div>
                        <div class="rate">
                            <div class="field bordered">
                                <input class="input-label form-control" value="Rate">
                            </div>
                        </div>
                        <div class="amount">
                            <div class="field bordered">
                                <input class="input-label form-control" value="Amount">
                            </div>
                        </div>

                    </div>
                <div class="field_wrapper">
                    <div class="invoice_items_2">
                        <div class="name">
                            <textarea name="itemname[]" id="" class="item-name" placeholder="Description of service or product..."></textarea>
                        </div>
                        <div class="quantity">
                            <input type="number" name="itemqty[]" step="any"
                                class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched item-qty"
                                autocomplete="off" ng-model="item.quantity" tabindex="42" placeholder="Quantity"
                                required="" value="1">
                        </div>
                        <div class="rate">


                            <div class="input-amount">
                                <div class="currency-sign">DT</div>
                                <div class="input-group-addon">
                                    <input class="form-control item-rate" name="itemrates[]">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" class="amount-input" name="singleitemamount[]">

                        <div class="amount item-amount">
                            $ 0.000
                       
                        </div>

                        <div class="invoice-close">
                        <button type="button" class="removeline"><i class='bx bx-x'></i></button>
                        </div>

                    </div>
                </div>

                    <div class="invoice-btn">
                        <button class="themeBtn addline"> <i class='bx bx-plus-medical'></i> Line Item</button>
                    </div>

                    <div class="row">
                        <div class="col-md-7">

                            <div class="invoice_form">
                                <form>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Notes</label>
                                                <textarea name="note" id="" class="form-control"
                                                    placeholder="Notes - any relevant information not already covered"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Terms</label>
                                                <textarea name="term" id="" class="form-control"
                                                    placeholder="Terms and conditions - late fees, payment methods, delivery schedule"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class=" col-md-5">
                            <div class="form-subtotal form-date">
                                <ul>
                                    <li>
                                        <div class="input-group addon-input">
                                            <input name="subtotallable" class="input-label form-control" value="Subtotal">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="amount subtotal">
                                            $ 0.000
                                            
                                        </div>
                                        <input type="hidden" class="subtotalh" name="subtotalh">
                                    </li>
                                </ul>

                                <div class="discount_box dis-tab">
                                    <ul>
                                        <li>
                                            <div class="input-group addon-input">
                                                <input name="discount_lable" class="input-label form-control" value="Discount">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rate">


                                                <div class="input-amount">
                                                    <div class="currency-sign">DT</div>
                                                    <div class="input-group-addon">
                                                        <input name="discount" class="form-control discount">
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <button class="disc-close close"><i class="fa fa-close"></i></button>
                                    </ul>

                                </div>
                                <div class="tax_box dis-tab">
                                    <ul>
                                        <li>
                                            <div class="input-group addon-input">
                                                <input name="tax_lable" class="input-label form-control" value="Tax">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="input-group-addon">
                                                <input name="tax" class="form-control tax">
                                            </div>
                                        </li>
                                        <button class="close-tax close"><i class="fa fa-close"></i></button>
                                    </ul>

                                </div>
                                <div class="shipping_box dis-tab">
                                    <ul>
                                        <li>
                                            <div class="input-group addon-input">
                                                <input name="shipping_lable" class="input-label form-control" value="Shipping">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="input-group-addon">
                                                <input  name="shipping" class="form-control shipping">
                                            </div>
                                        </li>
                                        <button class="ship-close close"><i class="fa fa-close"></i></button>
                                    </ul>

                                </div>

                                <div class="cart-box">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="discount-plus">
                                                <a href="javascript:void(0)" id="discount-icon"><i
                                                        class="bx bx-plus-medical"></i> Discount </a>
                                            </div>
                                        </div>
                                        <div class="col-md-1 p-0">
                                            <div class="discount-plus">

                                                <a href="javascript:void(0)" id="tax-icon"><i
                                                        class="bx bx-plus-medical"></i>Tax </a>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="discount-plus">

                                                <a href="javascript:void(0)" id="shipping-icon"><i
                                                        class="bx bx-plus-medical"></i> Shipping </a>
                                            </div>
                                        </div>
                                    </div>




                                </div>

                                <ul>
                                    <li>
                                        <div class="input-group addon-input">
                                            <input class="input-label form-control" value="Total">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="amount total">
                                            $ 0.000
                                            
                                        </div>
                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="input-group addon-input">
                                            <input name="amount_paidlable" class="input-label form-control" value="Amount Paid">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="amount">
                                            <div class="input-amount">
                                                <div class="currency-sign">DT</div>
                                                <div class="input-group-addon">
                                                    <input  name="amount_paid"class="form-control paidamount">
                                                </div>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                                <ul>
                                    <li>
                                        <div class="input-group addon-input">
                                            <input class="input-label form-control" value="Balance Due">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="amount balancedue">
                                            $ 0.000
                                            <input type="hidden" class="balancedueh" name="blance" id="">
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="send-invoice-sec">
                    <div class="send-invoice">
                        <button type="button" class="themeBtn" ng-disabled="documentForm.$invalid"
                            ng-click="sendModal()" tabindex="1050" disabled="disabled">
                            Send Invoice
                        </button>
                    </div>
                    <div class="download-invoice text-center">
                        <button type="button" class="btn btn-link ng-binding" ng-disabled="documentForm.$invalid"
                            ng-click="downloadModal()" tabindex="1051" disabled="disabled">
                            <!-- <i class='bx bx-down-arrow-alt'></i> -->
                            Download Invoice
                        </button>
                    </div>

                    <div class="selected-currency">
                        <label class="control-label">Currency</label>
                        <div>
                            <div class="invoiced-select">
                                <select ng-model="document.currency"
                                    ng-options="currency.code as currency.name for (code, currency) in currencies"
                                    class="ng-pristine ng-untouched ng-valid form-control">
                                    <option value="AED" label="AED (د.إ)">AED (د.إ)</option>
                                    <option value="AFN" label="AFN">AFN</option>
                                    <option value="ALL" label="ALL (Lek)">ALL (Lek)</option>
                                    <option value="AMD" label="AMD">AMD</option>
                                    <option value="ANG" label="ANG (ƒ)">ANG (ƒ)</option>
                                    <option value="AOA" label="AOA (Kz)">AOA (Kz)</option>
                                    <option value="ARS" label="ARS ($)">ARS ($)</option>
                                    <option value="AUD" label="AUD ($)">AUD ($)</option>
                                    <option value="AWG" label="AWG (ƒ)">AWG (ƒ)</option>
                                    <option value="AZN" label="AZN (ман)">AZN (ман)</option>
                                    <option value="BAM" label="BAM (KM)">BAM (KM)</option>
                                    <option value="BBD" label="BBD ($)">BBD ($)</option>
                                    <option value="BDT" label="BDT (Tk)">BDT (Tk)</option>
                                    <option value="BGN" label="BGN (лв)">BGN (лв)</option>
                                    <option value="BHD" label="BHD">BHD</option>
                                    <option value="BIF" label="BIF">BIF</option>
                                    <option value="BMD" label="BMD ($)">BMD ($)</option>
                                    <option value="BND" label="BND ($)">BND ($)</option>
                                    <option value="BOB" label="BOB ($b)">BOB ($b)</option>
                                    <option value="BOV" label="BOV">BOV</option>
                                    <option value="BRL" label="BRL (R$)">BRL (R$)</option>
                                    <option value="BSD" label="BSD ($)">BSD ($)</option>
                                    <option value="BTN" label="BTN">BTN</option>
                                    <option value="BWP" label="BWP (P)">BWP (P)</option>
                                    <option value="BYN" label="BYN (Br)">BYN (Br)</option>
                                    <option value="BZD" label="BZD (BZ$)">BZD (BZ$)</option>
                                    <option value="CAD" label="CAD ($)">CAD ($)</option>
                                    <option value="CDF" label="CDF">CDF</option>
                                    <option value="CHE" label="CHE">CHE</option>
                                    <option value="CHF" label="CHF">CHF</option>
                                    <option value="CHW" label="CHW">CHW</option>
                                    <option value="CLF" label="CLF">CLF</option>
                                    <option value="CLP" label="CLP ($)">CLP ($)</option>
                                    <option value="CNY" label="CNY (¥)">CNY (¥)</option>
                                    <option value="COP" label="COP (p.)">COP (p.)</option>
                                    <option value="COU" label="COU">COU</option>
                                    <option value="CRC" label="CRC (₡)">CRC (₡)</option>
                                    <option value="CUC" label="CUC">CUC</option>
                                    <option value="CUP" label="CUP (₱)">CUP (₱)</option>
                                    <option value="CVE" label="CVE">CVE</option>
                                    <option value="CZK" label="CZK (Kč)">CZK (Kč)</option>
                                    <option value="DJF" label="DJF (CHF)">DJF (CHF)</option>
                                    <option value="DKK" label="DKK (kr)">DKK (kr)</option>
                                    <option value="DOP" label="DOP (RD$)">DOP (RD$)</option>
                                    <option value="DZD" label="DZD">DZD</option>
                                    <option value="EGP" label="EGP (E£)">EGP (E£)</option>
                                    <option value="ERN" label="ERN">ERN</option>
                                    <option value="ETB" label="ETB">ETB</option>
                                    <option value="EUR" label="EUR (€)">EUR (€)</option>
                                    <option value="FJD" label="FJD ($)">FJD ($)</option>
                                    <option value="FKP" label="FKP (£)">FKP (£)</option>
                                    <option value="GBP" label="GBP (£)">GBP (£)</option>
                                    <option value="GEL" label="GEL">GEL</option>
                                    <option value="GHS" label="GHS (GH¢)">GHS (GH¢)</option>
                                    <option value="GIP" label="GIP (£)">GIP (£)</option>
                                    <option value="GMD" label="GMD">GMD</option>
                                    <option value="GNF" label="GNF">GNF</option>
                                    <option value="GTQ" label="GTQ (Q)">GTQ (Q)</option>
                                    <option value="GYD" label="GYD ($)">GYD ($)</option>
                                    <option value="HKD" label="HKD (HK$)">HKD (HK$)</option>
                                    <option value="HNL" label="HNL (L)">HNL (L)</option>
                                    <option value="HRK" label="HRK (kn)">HRK (kn)</option>
                                    <option value="HTG" label="HTG">HTG</option>
                                    <option value="HUF" label="HUF (Ft)">HUF (Ft)</option>
                                    <option value="IDR" label="IDR (Rp)">IDR (Rp)</option>
                                    <option value="ILS" label="ILS (₪)">ILS (₪)</option>
                                    <option value="INR" label="INR (Rs)">INR (Rs)</option>
                                    <option value="IQD" label="IQD">IQD</option>
                                    <option value="IRR" label="IRR">IRR</option>
                                    <option value="ISK" label="ISK (kr)">ISK (kr)</option>
                                    <option value="JMD" label="JMD (J$)">JMD (J$)</option>
                                    <option value="JOD" label="JOD">JOD</option>
                                    <option value="JPY" label="JPY (¥)">JPY (¥)</option>
                                    <option value="KES" label="KES (KSh)">KES (KSh)</option>
                                    <option value="KGS" label="KGS (лв)">KGS (лв)</option>
                                    <option value="KHR" label="KHR (៛)">KHR (៛)</option>
                                    <option value="KMF" label="KMF">KMF</option>
                                    <option value="KPW" label="KPW (₩)">KPW (₩)</option>
                                    <option value="KRW" label="KRW (₩)">KRW (₩)</option>
                                    <option value="KWD" label="KWD (ك)">KWD (ك)</option>
                                    <option value="KYD" label="KYD ($)">KYD ($)</option>
                                    <option value="KZT" label="KZT (лв)">KZT (лв)</option>
                                    <option value="LAK" label="LAK (₭)">LAK (₭)</option>
                                    <option value="LBP" label="LBP (£)">LBP (£)</option>
                                    <option value="LKR" label="LKR (Rs)">LKR (Rs)</option>
                                    <option value="LRD" label="LRD ($)">LRD ($)</option>
                                    <option value="LSL" label="LSL">LSL</option>
                                    <option value="LYD" label="LYD (LD)">LYD (LD)</option>
                                    <option value="MAD" label="MAD">MAD</option>
                                    <option value="MDL" label="MDL">MDL</option>
                                    <option value="MGA" label="MGA">MGA</option>
                                    <option value="MKD" label="MKD (ден)">MKD (ден)</option>
                                    <option value="MMK" label="MMK">MMK</option>
                                    <option value="MNT" label="MNT (₮)">MNT (₮)</option>
                                    <option value="MOP" label="MOP">MOP</option>
                                    <option value="MRU" label="MRU">MRU</option>
                                    <option value="MUR" label="MUR (Rs)">MUR (Rs)</option>
                                    <option value="MVR" label="MVR">MVR</option>
                                    <option value="MWK" label="MWK">MWK</option>
                                    <option value="MXN" label="MXN ($)">MXN ($)</option>
                                    <option value="MXV" label="MXV">MXV</option>
                                    <option value="MYR" label="MYR (RM)">MYR (RM)</option>
                                    <option value="MZN" label="MZN (MT)">MZN (MT)</option>
                                    <option value="NAD" label="NAD (N$)">NAD (N$)</option>
                                    <option value="NGN" label="NGN (₦)">NGN (₦)</option>
                                    <option value="NIO" label="NIO (C$)">NIO (C$)</option>
                                    <option value="NOK" label="NOK (kr)">NOK (kr)</option>
                                    <option value="NPR" label="NPR (Rs)">NPR (Rs)</option>
                                    <option value="NZD" label="NZD ($)">NZD ($)</option>
                                    <option value="OMR" label="OMR">OMR</option>
                                    <option value="PAB" label="PAB (B/.)">PAB (B/.)</option>
                                    <option value="PEN" label="PEN (S/.)">PEN (S/.)</option>
                                    <option value="PGK" label="PGK">PGK</option>
                                    <option value="PHP" label="PHP (₱)">PHP (₱)</option>
                                    <option value="PKR" label="PKR (Rs)">PKR (Rs)</option>
                                    <option value="PLN" label="PLN (zł)">PLN (zł)</option>
                                    <option value="PYG" label="PYG (Gs)">PYG (Gs)</option>
                                    <option value="QAR" label="QAR">QAR</option>
                                    <option value="RON" label="RON (lei)">RON (lei)</option>
                                    <option value="RSD" label="RSD (Дин.)">RSD (Дин.)</option>
                                    <option value="RUB" label="RUB (руб)">RUB (руб)</option>
                                    <option value="RWF" label="RWF">RWF</option>
                                    <option value="SAR" label="SAR">SAR</option>
                                    <option value="SBD" label="SBD ($)">SBD ($)</option>
                                    <option value="SCR" label="SCR (Rs)">SCR (Rs)</option>
                                    <option value="SDG" label="SDG">SDG</option>
                                    <option value="SEK" label="SEK (kr)">SEK (kr)</option>
                                    <option value="SGD" label="SGD ($)">SGD ($)</option>
                                    <option value="SHP" label="SHP (£)">SHP (£)</option>
                                    <option value="SLL" label="SLL">SLL</option>
                                    <option value="SOS" label="SOS (S)">SOS (S)</option>
                                    <option value="SRD" label="SRD ($)">SRD ($)</option>
                                    <option value="SSP" label="SSP">SSP</option>
                                    <option value="STN" label="STN">STN</option>
                                    <option value="SVC" label="SVC ($)">SVC ($)</option>
                                    <option value="SYP" label="SYP (£)">SYP (£)</option>
                                    <option value="SZL" label="SZL">SZL</option>
                                    <option value="THB" label="THB (฿)">THB (฿)</option>
                                    <option value="TJS" label="TJS">TJS</option>
                                    <option value="TMT" label="TMT">TMT</option>
                                    <option value="$" selected="selected" label="$ (DT)">$ (DT)</option>
                                    <option value="TOP" label="TOP">TOP</option>
                                    <option value="TRY" label="TRY">TRY</option>
                                    <option value="TTD" label="TTD (TT$)">TTD (TT$)</option>
                                    <option value="TWD" label="TWD (NT$)">TWD (NT$)</option>
                                    <option value="TZS" label="TZS (TSh)">TZS (TSh)</option>
                                    <option value="UAH" label="UAH (₴)">UAH (₴)</option>
                                    <option value="UGX" label="UGX (USh)">UGX (USh)</option>
                                    <option value="USD" label="USD ($)">USD ($)</option>
                                    <option value="USN" label="USN">USN</option>
                                    <option value="UYI" label="UYI">UYI</option>
                                    <option value="UYU" label="UYU ($U)">UYU ($U)</option>
                                    <option value="UYW" label="UYW">UYW</option>
                                    <option value="UZS" label="UZS (лв)">UZS (лв)</option>
                                    <option value="VES" label="VES">VES</option>
                                    <option value="VND" label="VND (₫)">VND (₫)</option>
                                    <option value="VUV" label="VUV">VUV</option>
                                    <option value="WST" label="WST">WST</option>
                                    <option value="XAF" label="XAF">XAF</option>
                                    <option value="XAG" label="XAG">XAG</option>
                                    <option value="XAU" label="XAU">XAU</option>
                                    <option value="XBA" label="XBA">XBA</option>
                                    <option value="XBB" label="XBB">XBB</option>
                                    <option value="XBC" label="XBC">XBC</option>
                                    <option value="XBD" label="XBD">XBD</option>
                                    <option value="XCD" label="XCD ($)">XCD ($)</option>
                                    <option value="XDR" label="XDR">XDR</option>
                                    <option value="XOF" label="XOF">XOF</option>
                                    <option value="XPD" label="XPD">XPD</option>
                                    <option value="XPF" label="XPF">XPF</option>
                                    <option value="XPT" label="XPT">XPT</option>
                                    <option value="XSU" label="XSU">XSU</option>
                                    <option value="XTS" label="XTS">XTS</option>
                                    <option value="XUA" label="XUA">XUA</option>
                                    <option value="XXX" label="XXX">XXX</option>
                                    <option value="YER" label="YER">YER</option>
                                    <option value="ZAR" label="ZAR (R)">ZAR (R)</option>
                                    <option value="ZMW" label="ZMW (ZK)">ZMW (ZK)</option>
                                    <option value="ZWL" label="ZWL">ZWL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="save-default">
                        <a href="javascriptvoid(0)" class="save-def">
                            Save 
                        </a>
                    </div>
                    <div class="histroy">
                        <a href="#" class="hist">

                            History

                        </a>
                    </div>


                </div>
            </div>

        </div>
    </div>
</section>
</form>

@endsection
@section('css')
<style type="text/css">
    /*in page css here*/
  
</style>
@endsection
@section('js')

<script type="text/javascript">
    function logo(input) {
        if (input.files && input.files[0]) {
            
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('.logo-img')
                    .attr('src', e.target.result);
                   
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    (() => {

        
 

//   $(".item-rate").change(function(){

    
//     var qty = parseInt($(".item-qty").val());
//       var rate =  parseInt($(".item-rate").val());
//       if(qty != '' && rate != ''){
//         var sum  = qty * rate;
   
//       var amount =  $(".item-amount").html(sum);
//       }
      
   
//   });



var maxField = 10;
var fieldHTML = ' <div class="invoice_items_2"><div class="name"><textarea name="itemname[]" class="item-name" id="" placeholder="Description of service or product..."></textarea></div><div class="quantity"><input type="number" name="itemqty[]" value="1" step="any" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched item-qty" autocomplete="off" ng-model="item.quantity" tabindex="42" placeholder="Quantity" required=""></div><div class="rate"><div class="input-amount"><div class="currency-sign">DT</div><div class="input-group-addon"><input class="form-control item-rate" name="itemrates[]"></div></div></div><input type="hidden" class="amount-input" name="singleitemamount[]"><div class="amount item-amount">$ 0.000</div><div class="invoice-close"><button type="button" class="removeline"><i class="bx bx-x"></i></button></div></div>'
var x = 1;
$('.addline').click(function(){
    if(x < maxField){ 
        x++; 
 $('.field_wrapper').append(fieldHTML);
}
// else{
//     $('.field_wrapper').append('<p></p>');
// }

});

        


$( "body" ).on( "click", ".removeline", function() {
  
        $(this).parent().parent().remove(); //Remove field html
         //Decrement field counter
    });

 
                
    $( "body" ).on( "change", ".item-rate", function() {

        
        var getrates = $(this).val();

        if(getrates == '')
        {
            $(this).parent().parent().parent().parent().find('.item-amount').html('$ 0.00');
            $(this).parent().parent().parent().parent().find('.amount-input').val('0.00');
        }
        else
        {
            var getqty = parseFloat($(this).parent().parent().parent().parent().find('.item-qty').val());
            getrates = parseFloat(getrates);
            // console.log(getrates);
            // console.log(getqty);
            var abc = (getrates * getqty);
            // console.log(abc);
            $(this).parent().parent().parent().parent().find('.item-amount').html('$ '+abc);
            $(this).parent().parent().parent().parent().find('.amount-input').val(abc);
            
            var subsotal=0;
            $( ".amount-input" ).each(function( index,element) {
               
               subsotal += Number($(this).val());
            //    console.log(subsotal);
               });
               
               $('.subtotal').html('$'+subsotal);

               $('.subtotalh').val(subsotal);

                $( "body" ).on( "change", ".discount", function() {
    var discount = parseInt($('.discount').val());
    
    if(discount != ''){
    var  total = parseFloat(subsotal - discount );
    // console.log(total);
    subsotal = total;
    // console.log(total);
    $('.total').html('$'+total);
    $('.total').val(total);
    
    }
  });


  $( "body" ).on( "change", ".tax", function() {
    var tax = parseInt($('.tax').val());
    // console.log(tax);
    if(tax != ''){
    var  total = parseFloat(tax + subsotal);
    subsotal = total;
    // console.log(total);
    $('.total').html('$'+total);
    $('.total').val(total);
    
    }
  });

  $( "body" ).on( "change", ".shipping", function() {
    var shipping = parseInt($('.shipping').val());
    // console.log(tax);
    if(shipping != ''){
    var  total = parseFloat(shipping + subsotal);
    subsotal = total;
    // console.log(total);
    $('.total').html('$'+total);
    $('.total').val(total);
    
    }
  });

  $( "body" ).on( "change", ".paidamount", function() {
    var paidamount = parseInt($('.paidamount').val());
    // console.log(paidamount);
    if(paidamount != ''){
    var  finaltotal = parseFloat(paidamount - subsotal);
    // subsotal = total;
    console.log(finaltotal);
    $('.balancedue').html('$'+balancedue);
    $('.balancedueh').val(balancedue);
    
    }
  });
//   $( "body" ).on( "change", ".shipping", function() {
//     var shippingamount = parseInt($('.shipping').val());
    
//     if(shippingamount != ''){
//     var  total = parseFloat(paidamount + total);
//     console.log(total);
//     $('.total').html('$'+total);
    
//     }
//   });
  

  


        
        }
        
        

    });    


    $( "body" ).on( "keyup", ".item-qty", function() {
        var  getqty = $(this).val();
        if(getqty == '')
        {
            $(this).parent().parent().parent().parent().find('.item-amount').html('$ 0.00');
            $(this).parent().parent().parent().parent().find('.amount-input').val('0.00');
        }
        else
        {
            var getrates = parseFloat($(this).parent().parent().parent().parent().find('.item-rate').val());
            getqty = parseFloat(getqty);
            // console.log(getrates);
            // console.log(getqty);
            var abc = (getrates * getqty);
            // console.log(abc);
            $(this).parent().parent().parent().parent().find('.item-amount').html('$ '+abc);
            $(this).parent().parent().parent().parent().find('.amount-input').val(abc);
            var subsotal=0;
            $( ".amount-input" ).each(function( index,element) {
               
               subsotal += Number($(this).val());
            //    console.log(subsotal);
               });
               
               $('.subtotal').html('$'+subsotal);


//                $( "body" ).on( "change", ".discount", function() {
//     var discount = parseInt($('.discount').val());
    
//     if(discount != ''){
//     var  total = Math.abs(discount - subsotal);
//     console.log(total);
//     $('.total').html('$'+total);
    
//     }
//   });
   
        }
    });    
    

      



        $('.discount_box').hide();

$('#discount-icon').click(function(){
    $('.discount_box').show();
});
$('.disc-close').click(function(){
    $('.discount_box').hide();
   
});



$('.tax_box').hide();

$('#tax-icon').click(function(){
    $('.tax_box').show();
});
$('.close-tax').click(function(){
    $('.tax_box').hide();
});



$('.shipping_box').hide();

$('#shipping-icon').click(function(){
    $('.shipping_box').show();
});
$('.ship-close').click(function(){
    $('.shipping_box').hide();
});
       


$( ".save-def" ).click(function(e) {
    Loader.show();
       
    e.preventDefault();
    // e.preventDefault();
     
      var data = new FormData(document.getElementById("invoice-form"));
       //console.log(data);
    //   return 0;
      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $.ajax({
    			type:'POST',
    			url:'{{route('admin.create_invoice')}}',
    			data:data,
			    enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
               
    			success:function(data) {
    
                    Loader.hide();
                   
                if(data.status == 1){
                        $.toast({
                        heading: 'Success!',
                        position: 'top-right',
                        text:  data.msg,
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 2500,
                        stack: 6
                    });
    
                    $('.invoice-form')[0].reset();
                    setInterval(() => {
                        
                        location.reload();
                    }, 2500);
                     
                    // $("#change-password-modal").modal("hide"); 
                }
    
           
            if(data.status == 2){
                $.toast({
    				heading: 'Error!',
    				position: 'bottom-right',
    				text:  data.error,
    				loaderBg: '#ff6849',
    				icon: 'error',
    				hideAfter: 5000,
    				stack: 6
    			});
            }
            // $('#updatepwd')[0].reset();
    	    }
    
    			});
    });



    })()

</script>
@endsection

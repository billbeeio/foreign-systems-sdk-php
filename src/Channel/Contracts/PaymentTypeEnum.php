<?php

namespace Billbee\ForeignSystemsSdk\Channel\Contracts;

enum PaymentTypeEnum: int
{
    case BankTransfer = 1;
    case CashOnDelivery = 2;
    case PayPal = 3;
    case CashPayment = 4;
    case Voucher = 6;
    case SofortBankTransfer = 19;
    case MoneyOrder = 20;
    case Check = 21;
    case Other = 22;
    case DirectDebit = 23;
    case Moneybookers = 24;
    case KlarnaInvoice = 25;
    case Invoice = 26;
    case MoneybookersCreditCard = 27;
    case MoneybookersDirectDebit = 28;
    case BillPayInvoice = 29;
    case BillPayDirectDebit = 30;
    case CreditCard = 31;
    case Maestro = 32;
    case Ideal = 33;
    case Eps = 34;
    case P24 = 35;
    case ClickAndBuy = 36;
    case GiroPay = 37;
    case NovalnetDirectDebit = 38;
    case KlarnaPartPayment = 39;
    case IPaymentCC = 40;
    case BillSafe = 41;
    case TestOrder = 42;
    case WireCardCreditCard = 43;
    case AmazonPayments = 44;
    case SecupayCreditCard = 45;
    case SecupayDirectDebit = 46;
    case WireCardDirectDebit = 47;
    case EC = 48;
    case PaymillCreditCard = 49;
    case NovalnetCreditCard = 50;
    case NovalnetInvoice = 51;
    case NovalnetPayPal = 52;
    case Paymill = 53;
    case InvoicePayPal = 54;
    case Selekkt = 55;
    case AvocadoStore = 56;
    case DirectCheckout = 57;
    case Rakuten = 58;
    case Prepayment = 59;
    case CommissionSettlement = 60;
    case AmazonMarketplace = 61;
    case AmazonPaymentsAdvanced = 62;
    case Stripe = 63;
    case BillPayPayLater = 64;
    case PostFinance = 65;
    case IZettle = 66;
    case SumUp = 67;
    case Payleven = 68;
    case Atalanda = 69;
    case SaferpayCreditCard = 70;
    case WireCardPayPal = 71;
    case MicroPayment = 72;
    case InstallmentPurchase = 73;
    case Wayfair = 74;
    case MangoPayPayPal = 75;
    case MangoPaySofortBankTransfer = 76;
    case MangoPayCreditCard = 77;
    case MangoPayIdeal = 78;
    case PayPalExpress = 79;
    case PayPalDirectDebit = 80;
    case PayPalCreditCard = 81;
    case Wish = 82;
    case BancontactMisterCash = 83;
    case BelfiusDirectNet = 84;
    case KbcCbcPaymentButton = 85;
    case NovalnetPrzelewy24 = 86;
    case NovalnetPrepayment = 87;
    case NovalnetInstantBankTransfer = 88;
    case NovalnetIdeal = 89;
    case NovalnetEps = 90;
    case NovalnetGiroPay = 91;
    case NovalnetCashPayment = 92;
    case Kaufland = 93;
    case Fruugo = 94;
    case Cdiscount = 95;
    case PayDirekt = 96;
    case EtsyPayments = 97;
    case Klarna = 98;
    case Limango = 99;
    case SantanderInstallmentPurchase = 100;
    case SantanderInvoicePurchase = 101;
    case Cashpresso = 102;
    case Tipser = 103;
    case Ebay = 104;
    case Mollie = 105;
    case MollieInvoice = 106;
    case MollieCreditCard = 107;
    case MollieSofort = 108;
    case MollieGiroPay = 109;
    case MollieMaestro = 110;
    case MollieKlarnaPayLater = 111;
    case MolliePayPal = 112;
    case ApplePay = 113;
    case Braintree = 114;
    case BraintreeCreditCard = 115;
    case BraintreePayPal = 116;
    case MollieIdeal = 117;
    case Scalapay = 118;
    case OttoPayments = 119;
    case IdealoDirectPurchasePayments = 120;
    case EasyCredit = 121;
    case MollieApplePay = 122;
    case MollieEps = 123;
    case CrefoPayPrepaid = 124;
    case MollieBancontact = 125;
    case MolliePrzelewy24 = 126;
    case MollieKlarnaInstallmentPurchase = 127;
    case MollieKlarnaSliceIt = 128;
    case GooglePay = 129;
    case MollieKlarnaPayNow = 130;
    case MultiSafepay = 131;
    case RatepayInvoice = 132;
    case HoodPay = 133;
    case Quickpay = 134;
    case PayPalPayLater = 135;
    case MollieBankTransfer = 137;
    case Lena = 138;
    case WixPayments = 139;
    case ZalandoPayments = 140;
    case MollieBillie = 141;
    case IvyPayments = 142;
    case Twint = 143;
    case ShopifyPayments = 144;
    case ShopApotheke = 145;
    case Douglas = 146;
    case ZiniaInvoicePurchase = 147;
    case Nexi = 148;
    case MfGroupInvoice = 149;
}
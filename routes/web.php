<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\BuyedProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomSack;
use App\Http\Controllers\CustomSackController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoznamchaController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SuperAdminController;
use App\Models\Sale;
use Illuminate\Support\Facades\Route;




// Route::get('/forms', function () {
//     return view('form');
// });



Route::middleware('auth')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        // Route::get('/orders/{id}', 'show');
        Route::get('/forms', 'showProduct')->name('showProduct');
        Route::post('/addProduct', 'addProduct')->name('addProduct');
        Route::get('/editProduct/{id}', 'editProduct')->name('editProduct');
        Route::post('/updateProduct/{id}', 'updateProduct')->name('updateProduct');
        Route::get('/deleteProduct/{id}', 'deleteProduct')->name('deleteProduct');

    });
});




Route::middleware('auth')->group(function () {
Route::controller(CustomerController::class)->group(function () {
    Route::get('/showCustomers', 'showCustomers')->name('showCustomers');
    Route::get('/customerForm', 'customerForm')->name('customerForm');
    Route::post('/addCustomer', 'addCustomer')->name('addCustomer');
    Route::get('/editCustomer/{id}', 'editCustomer')->name('editCustomer');
    Route::post('/updateCustomer/{id}', 'updateCustomer')->name('updateCustomer');
    Route::get('/deleteCustomer/{id}', 'deleteCustomer')->name('deleteCustomer');
    Route::get('/showDeletedCustomers', 'showDeletedCustomers')->name('showDeletedCustomers');
    Route::get('/restoreCustomer/{id}', 'restoreCustomer')->name('restoreCustomer');
    Route::get('/permanentDeleteCustomer/{id}', 'permanentDeleteCustomer')->name('permanentDeleteCustomer');

});
});






Route::middleware('auth')->group(function () {
Route::controller(CustomSackController::class)->group(function () {
    // Route::get('/orders/{id}', 'show');
    Route::get('/showSack', 'showSack')->name('showSack');
    Route::post('/addSack', 'addSack')->name('addSack');
    Route::get('/editSack/{id}', 'editSack')->name('editSack');
    Route::post('/updateSack/{id}', 'updateSack')->name('updateSack');
    Route::get('/deleteSack/{id}', 'deleteSack')->name('deleteSack');

});
});


Route::middleware('auth')->group(function () {
    Route::controller(SellerController::class)->group(function () {
       Route::get('/showSellers', 'showSeller')->name('showSellers');
       Route::get('/sellerForm', 'sellerForm')->name('sellerForm');
       Route::post('/addSeller', 'addSeller')->name('addSeller');
       Route::get('/editSeller/{id}', 'editSeller')->name('editSeller');
       Route::post('/updateSeller/{id}', 'updateSeller')->name('updateSeller');
       Route::get('/deleteSeller/{id}', 'deleteSeller')->name('deleteSeller');
       Route::get('/showDeletedSellers', 'showDeletedSellers')->name('showDeletedSellers');
       Route::get('/restoreSeller/{id}', 'restoreSeller')->name('restoreSeller');
       Route::get('/permanentDeleteSeller/{id}', 'permanentDeleteSeller')->name('permanentDeleteSeller');



       Route::get('/sendPayments', 'sendPayments')->name('sendPayments');
       Route::get('/sendedPaymentForm/{id}', 'sendedPaymentForm')->name('sendedPaymentForm');
       Route::get('/sendedPaymentDetails/{id}', 'sendedPaymentDetails')->name('sendedPaymentDetails');
       Route::post('/sendedPayment', 'sendedPayment')->name('sendedPayment');

    });
});




    Route::middleware('auth')->group(function () {
    Route::controller(BuyedProductController::class)->group(function () {
        Route::get('/showBuyedProducts', 'showBuyedProducts')->name('showBuyedProducts');
        Route::get('/buyedProductForm', 'buyedProductForm')->name('buyedProductForm');
        Route::post('/addBuyedProduct', 'addBuyedProduct')->name('addBuyedProduct');
        Route::get('/removeProductCart/{id}', 'removeProductCart')->name('removeProductCart');
        Route::post('/addReceivedProduct', 'addReceivedProduct')->name('addReceivedProduct');

        Route::get('/dayDetails/{date}', 'dayDetails')->name('dayDetails');
        Route::get('/perSellerDetails/{sellerId}/{vehicle}/{date}', 'perSellerDetails')->name('perSellerDetails');
        Route::get('/sellerSaleDetails/{sellerId}/{vehicle}/{date}', 'sellerSaleDetails')->name('sellerSaleDetails');
        Route::get('/editbuyedProduct/{id}', 'editbuyedProduct')->name('editbuyedProduct');
        Route::post('/updateBuyedProduct', 'updateBuyedProduct')->name('updateBuyedProduct');


        Route::get('/payment/{sellerId}/{vehicle}/{date}', 'payment')->name('payment');
        Route::get('/amountDetails/{sellerId}/{vehicle}/{date}', 'amountDetails')->name('amountDetails');
        Route::get('/editAmount/{sellerId}/{vehicle}/{date}', 'editAmount')->name('editAmount');
        Route::post('/updateAmount', 'updateAmount')->name('updateAmount');
        Route::post('/addAmount', 'addAmount')->name('addAmount');


       Route::get('/sendAmountForm/{sellerId}/{vehicle}/{date}', 'sendAmountForm')->name('sendAmountForm');
       Route::post('/sendAmount', 'sendAmount')->name('sendAmount');
       Route::get('/updateAmountForm/{sellerId}/{vehicle}/{date}', 'updateAmountForm')->name('updateAmountForm');
       Route::post('/updatePaymentSender', 'updatePaymentSender')->name('updatePaymentSender');

       //daily commission
       Route::get('/dailyCommission', 'dailyCommission')->name('dailyCommission');
       Route::get('/perDayCommission/{date}', 'perDayCommission')->name('perDayCommission');

       //roz namcha
       Route::get('/showRozNamcha', 'showRozNamcha')->name('showRozNamcha');


    });
});
        Route::prefix('SuperAdmin')->group(function () {
            Route::controller(SuperAdminController::class)->group(function () {

                Route::get('/amount', 'amount')->name('amount');
                Route::get('/receivedCashDetails/{date}', 'receivedCashDetails')->name('receivedCashDetails');
                Route::get('/showExpenseForm', 'showExpenseForm')->name('showExpenseForm');
                Route::get('/showExpense', 'showExpense')->name('showExpense');
                Route::post('/addExpense', 'addExpense')->name('addExpense');
                Route::get('/receivePaymentForm', 'receivePaymentForm')->name('receivePaymentForm');
                Route::post('/receivePayment', 'receivePayment')->name('receivePayment');
                Route::get('/showReceivedPayment', 'showReceivedPayment')->name('showReceivedPayment');
                Route::get('/expenseDetails/{date}', 'expenseDetails')->name('expenseDetails');
                Route::get('/daily', 'daily')->name('daily');

                // Route::post('/orders', 'store');
            });

        });

    Route::middleware('auth')->group(function () {
    Route::controller(SaleController::class)->group(function () {
        Route::get('/showSales', 'showSales')->name('showSales');
        Route::get('/saleForm', 'saleForm')->name('saleForm');
        Route::post('/addSale', 'addSale')->name('addSale');
        Route::post('/check-quantity', 'checkQuantity')->name('check.quantity');
        Route::get('/saleDetails/{customerId}', 'saleDetails')->name('saleDetails');
        Route::get('/editSale/{id}', 'editSale')->name('editSale');
        Route::post('/updateSale/{id}', 'updateSale')->name('updateSale');
        Route::get('/deleteSale/{id}', 'deleteSale')->name('deleteSale');
        Route::get('/addPaymentForm/{customerId}/{gd}', 'addPaymentForm')->name('addPaymentForm');

        //payment of customer
        Route::post('/addPayment', 'addPayment')->name('addPayment');
        Route::get('/editpayment/{id}', 'editpayment')->name('editpayment');
        Route::get('/deletepayment/{id}', 'deletepayment')->name('deletepayment');
        Route::post('/updatePayment/{id}', 'updatePayment')->name('updatePayment');


        //yesterday sales
        Route::get('/addYesterdayPaymentForm/{id}/{gd}', 'addYesterdayPaymentForm')->name('addYesterdayPaymentForm');
        Route::post('/addYesterdayPayment', 'addYesterdayPayment')->name('addYesterdayPayment');
        Route::get('/showYesterdaySales', 'showYesterdaySales')->name('showYesterdaySales');
        Route::get('/yesterdaySaleDetails/{customerId}', 'yesterdaySaleDetails')->name('yesterdaySaleDetails');
      //all sales
      Route::get('/allSales', 'allSales')->name('allSales');
      Route::get('/addOldPaymentForm/{customerId}/{gd}/{created_at}', 'addOldPaymentForm')->name('addOldPaymentForm');
      Route::post('/addOldPayment', 'addOldPayment')->name('addOldPayment');

        //overall sales
        Route::get('/showSalesRecords', 'showSalesRecords')->name('showSalesRecords');
        Route::get('/SaleRecordsDetails/{date}', 'SaleRecordsDetails')->name('SaleRecordsDetails');
        Route::get('/oldSaleEdit/{id}/{date}', 'oldSaleEdit')->name('oldSaleEdit');
        Route::get('/totalProductQuantity', 'totalProductQuantity')->name('totalProductQuantity');
        Route::get('/recordDetails/{customerId}/{date}', 'recordDetails')->name('recordDetails');
        //payment records
        // payment record list of all customers
        Route::get('/showPaymentRecords', 'showPaymentRecords')->name('showPaymentRecords');
         // payment record list of single customer
        Route::get('/paymentRecord/{customerId}', 'paymentRecord')->name('paymentRecord');
         //single customer per day details
        Route::get('/paymentRecordDetails/{customerId}/{date}', 'paymentRecordDetails')->name('paymentRecordDetails');
         //add payment in old records
         Route::get('/paymentForm/{customerId}/{gd}', 'paymentForm')->name('paymentForm');
         Route::post('/paymentDetails', 'paymentDetails')->name('paymentDetails');
         Route::post('/paymentData', 'paymentData')->name('paymentData');
         Route::get('/collectedAmount', 'collectedAmount')->name('collectedAmount');
         Route::get('/collectedAmountDetails/{date}', 'collectedAmountDetails')->name('collectedAmountDetails');
         Route::get('/editCollectedAmount/{id}', 'editCollectedAmount')->name('editCollectedAmount');
         Route::post('/updateCollectedAmount', 'updateCollectedAmount')->name('updateCollectedAmount');
         Route::get('/editTodayAmount/{customerId}', 'editTodayAmount')->name('editTodayAmount');
         Route::post('/updateTodayPayment', 'updateTodayPayment')->name('updateTodayPayment');


         //export excel file records
        Route::get('/excelExport', 'excelExport')->name('excelExport');



        //old sales testing
        // Route::get('/oldSales', 'oldSales')->name('oldSales');

    });
});






Route::middleware('auth')->group(function () {
    Route::controller(RoznamchaController::class)->group(function () {
       Route::get('/showRozNamcha', 'showRozNamcha')->name('showRozNamcha');
       Route::get('/shopExpensesForm', 'shopExpensesForm')->name('shopExpensesForm');
       Route::post('/addShopExpense', 'addShopExpense')->name('addShopExpense');
       Route::post('/shopExpense', 'shopExpense')->name('shopExpense');
       Route::get('/removeShopExpense/{id}', 'removeShopExpense')->name('removeShopExpense');

       //daily sended payment
       Route::get('/dailySendedPaymentForm', 'dailySendedPaymentForm')->name('dailySendedPaymentForm');
       Route::post('/addDailySendedPayment', 'addDailySendedPayment')->name('addDailySendedPayment');
       Route::post('/sendedAmount', 'sendedAmount')->name('sendedAmount');
       Route::get('/removeSendedAmount/{id}', 'removeSendedAmount')->name('removeSendedAmount');
       Route::get('/showDailySendedPayment', 'showDailySendedPayment')->name('showDailySendedPayment');


        //daily received payment
        Route::get('/dailyReceivedPaymentForm', 'dailyReceivedPaymentForm')->name('dailyReceivedPaymentForm');
        Route::post('/addDailyReceivedPayment', 'addDailyReceivedPayment')->name('addDailyReceivedPayment');
        Route::post('/receivedAmount', 'receivedAmount')->name('receivedAmount');
        Route::get('/removeReceivedAmount/{id}', 'removeReceivedAmount')->name('removeReceivedAmount');
        Route::get('/showDailyReceivedPayment', 'showDailyReceivedPayment')->name('showDailyReceivedPayment');


        //add profit
        Route::get('/totalProfitForm/{date}', 'totalProfitForm')->name('totalProfitForm');
        Route::post('/totalProfit', 'totalProfit')->name('totalProfit');

        //rozNamcha Details
        Route::get('/rozNamchaDetails/{date}', 'rozNamchaDetails')->name('rozNamchaDetails');


    });
});


Route::get('/table', function () {
    return view('table');
});
Route::get('/widget', function () {
    return view('widget');
});
Route::get('/blank', function () {
    return view('blank');
});
Route::get('/chart', function () {
    return view('chart');
});
Route::get('/button', function () {
    return view('button');
});
Route::get('/typography', function () {
    return view('typography');
});



Route::middleware('auth')->group(function () {
Route::prefix('Product')->group(function(){
    Route::controller(ProductController::class)->group(function () {
        Route::get('/Products','product')->name('product');
        // Route::get('/orders/{id}', 'show');
        Route::post('/add-product', 'addProduct')->name('addProduct');
    });
});
});



Route::middleware('auth')->group(function () {
    Route::get('add-admin',[Admin::class,'addAdmin'])->name('addAdmin');
    Route::post('newAdmin',[Admin::class,'newAdmin'])->name('newAdmin');

});



Route::get('/', [Admin::class,'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

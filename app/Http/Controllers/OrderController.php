<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Helpers\PaymentHelper;
use App\Handler\PaymentHandler;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller {

    use PaymentHelper;

    public function index() {
        $orders = Order::orderBy('id', 'desc')->get();
        $statuses = config('constants.order_statuses');
        return view('pages.admin.orders.index', compact('orders', 'statuses'));
    }

    public function postSummary(OrderRequest $request) {

        $summary = $this->getPaymentData($request);

        $request->session()->put('summary', $summary);

        return redirect()->route('summary.index');
    }

    public function summary(Request $request) {

        if($request->session()->has('summary')) {
            $summary = $request->session()->get('summary');

            return view('pages.app.summary', compact('summary'));
        } else {
            session()->flash('error', ['Unable to fetch summary, please try again later']);

            return redirect()->route('home');
        }
    }

    public function process(Request $request) {
        $summary = $request->session()->get('summary');
        $data = new Request($summary->request);

        return (new PaymentHandler())->pay($data);
    }

    public function show(Order $order) {
        $statuses = config('constants.order_statuses');
        return view('pages.admin.orders.show', compact('order', 'statuses'));
    }

    public function update(Request $request, Order $order) {
        $order->update(['status' => $request->status]);

        session()->flash('success', ['Order successfully updated']);

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function testprint()
    {
        return view('testprint');
    }
    public function testprintcoba()
    {
        try {
            $connector = new NetworkPrintConnector("192.168.61.92", 9100);

            /* Print a "Hello world" receipt" */
            $printer = new Printer($connector);
            $printer->text("Hello World!\n");
            $printer->cut();

            /* Close printer */
            $printer->close();
        } catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
        }
    }
}

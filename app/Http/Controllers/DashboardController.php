<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Http\Controllers\PedidoController;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Dashboard del cliente
        if ($user->hasRole('admin')) {
            return $this->dashboardAdmin();
        }

        return $this->dashboardCliente();
    }

    private function dashboardAdmin()
    {
        // Aquí puedes reemplazar con queries reales cuando tengas los modelos listos
        // Ejemplo: $ventasHoy = Pedido::whereDate('created_at', today())->sum('total');
        return view('dashboard.admin');
    }

    private function dashboardCliente()
    {
        $user = Auth::user();

        // Pedidos del cliente autenticado
        $pedidos = \App\Models\Pedido::where('user_id', $user->id)
                    ->latest()
                    ->take(5)
                    ->get();

        // Catálogo (últimos productos activos)
        $productos = Producto::latest()->take(8)->get();

        return view('dashboard.cliente', compact('pedidos', 'productos'));
    }
}
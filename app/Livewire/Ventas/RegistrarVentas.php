<?php
namespace App\Livewire\Ventas;

use Livewire\Component;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RegistrarVentas extends Component
{
    public $fecha;
    public $nventa;
    public $cliente_id;

    public $categorias;
    public $marcas;
    public $productos;

    public $categoria_id;
    public $marca_id;
    public $producto_id;

    public $stock = 0;
    public $cantidad = 0;
    public $precio = 0;

    public $detalle = [];

    public $subtotal = 0;
    public $iva = 15;
    public $descuento = 0;
    public $ivatotal=0;
    public $descuentototal=0;
    public $total = 0;
    
    public function mount()
    {
        $this->fecha = Carbon::now()->toDateString();
        $this->nventa = Venta::max('id') + 1;
        $this->categorias = Categoria::all();
        $this->marcas = Marca::all();
        $this->productos = Producto::all();
    }

    public function agregarProductoDesdeFrontend($producto_id, $cantidad, $precio)
    {
        $producto = Producto::find($producto_id);

        if (!$producto) {
            session()->flash('error', 'Producto no encontrado.');
            return;
        }

        if ($producto->cantidadstock < $cantidad) {
            session()->flash('error', 'Cantidad solicitada excede el stock disponible.');
            return;
        }

        $subtotal = $precio * $cantidad;
        $descuentoMonto = $subtotal * ($this->descuento / 100);
        $subtotalDescuento = ($subtotal - $descuentoMonto);
        $ivaMonto = $subtotalDescuento * ($this->iva / 100);

        $total = $subtotalDescuento + $ivaMonto;

        $this->detalle[] = [
            'producto_id' => $producto->id,
            'categoria' => $producto->categoria->nombre_categoria,
            'marca' => $producto->marca->nombreMarca,
            'nombre' => $producto->nombreProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'subtotal' => $subtotal,
            'iva' => $ivaMonto,
            'descuento' => $descuentoMonto,
            'total' => $total
        ];

        $this->calcularTotales();
    }

    public function updatedProducto_id($value)
    {
        $producto = Producto::find($value);
        if ($producto) {
            $this->stock = $producto->cantidadstock;
            $this->precio = $producto->precio_producto;
        } else {
            $this->stock = 0;
            $this->precio = 0;
        }
    }

    public function productoSeleccionado()
    {
        $this->updatedProducto_id($this->producto_id);
    }

    public function eliminarProducto($index)
    {
        unset($this->detalle[$index]);
        $this->detalle = array_values($this->detalle);
        $this->calcularTotales();
    }

    public function calcularTotales()
    {
        /*$subtotal = $precio * $cantidad;
        $descuentoMonto = $subtotal * ($this->descuento / 100);
        $subtotalDescuento = ($subtotal - $descuentoMonto);
        $ivaMonto = $subtotalDescuento * ($this->iva / 100);*/

        $this->subtotal = collect($this->detalle)->sum('subtotal');
        $this->ivatotal = collect($this->detalle)->sum('iva');
        $this->descuentototal = collect($this->detalle)->sum('descuento');

        $descuentoCalculado = $this->subtotal * ($this->descuento / 100);
        $subtotalDescuento = $this->subtotal - $descuentoCalculado;
        $ivaCalculado = $subtotalDescuento * ($this->iva / 100);
        $this->total = $subtotalDescuento + $ivaCalculado;
    }

    public function updatedIva()
    {
        $this->calcularTotales();
    }

    public function updatedDescuento()
    {
        $this->calcularTotales();
    }

    public function updatedCantidad()
    {
        $this->calcularTotales();
    }

    public function updatedPrecio()
    {
        $this->calcularTotales();
    }

    public function limpiarProducto()
    {
        $this->producto_id = null;
        $this->stock = 0;
        $this->cantidad = 0;
        $this->precio = 0;
    }

    public function guardarVenta($redirect = false)
    {
        $this->validate([
            'fecha' => 'required|date',
            'nventa' => 'required|integer',
            'cliente_id' => 'required|exists:clientes,id',
            'detalle' => 'required|array|min:1',
            'iva' => 'numeric|min:0|max:15',
            'descuento' => 'numeric|min:0|max:100',
        ], [
            'fecha.required' => 'La fecha de la venta es obligatoria.',
            'nventa.required' => 'El número de venta es obligatorio.',
            'nventa.integer' => 'El número de venta debe ser un número entero.',
            'cliente_id.required' => 'Debe seleccionar un cliente.',
            'cliente_id.exists' => 'El cliente seleccionado no es válido.',
            'detalle.required' => 'Debe agregar al menos un producto a la venta.',
            'detalle.min' => 'Debe agregar al menos un producto a la venta.',
            'iva.numeric' => 'El IVA debe ser un número.',
            'iva.min' => 'El IVA no puede ser negativo.',
            'iva.max' => 'El IVA no puede ser mayor a 15%.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede ser mayor a 100%.',
        ]);

        try {
            $user = Auth::user();

            if (!$user->empleado) {
                throw new \Exception('El usuario no tiene un empleado asociado.');
            }

            $venta = Venta::create([
                'fecha' => $this->fecha,
                'nventa' => $this->nventa,
                'subtotal' => $this->subtotal,
                'iva' => $this->ivatotal,
                'descuento' => $this->descuentototal,
                'total' => $this->total,
                'empleado_id' => $user->empleado->id ?? null,
                'cliente_id' => $this->cliente_id,
                'usuario_id' => $user->id,
            ]);

            \Log::info('Venta creada correctamente: ', ['id' => $venta->id]);

            foreach ($this->detalle as $item) {
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['producto_id'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['precio'],
                    'subtotal' => $item['subtotal'],
                    'iva' => $item['iva'],
                    'descuento' => $item['descuento'],
                    'total' => $item['total'],
                ]);

                $producto = Producto::find($item['producto_id']);
                if ($producto) {
                    $producto->decrement('cantidadstock', $item['cantidad']);
                }
            }

            session()->flash('success', '¡Venta registrada exitosamente y stock actualizado!');
            $this->inicializarFormulario();

            if ($redirect) {
                return redirect()->route('facturacion');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error al registrar la venta: ' . $e->getMessage());
            \Log::error('Error al guardar venta: ' . $e->getMessage());
            dd($e);

        }
    }

    public function guardarYReiniciar()
    {
        $this->guardarVenta(false);
        $this->dispatch('refreshComponent');
    }

    public function inicializarFormulario()
    {
        $this->fecha = Carbon::now()->toDateString();
        $this->nventa = Venta::max('id');
        $this->cliente_id = null;
        $this->detalle = [];
        $this->subtotal = 0;
        $this->iva = 15;
        $this->descuento = 0;
        $this->total = 0;
        $this->limpiarProducto();
    }

    public function render()
    {
        $clientes = Cliente::all();
        // dd($clientes->toArray()); // Descomentar para depuración si los clientes no aparecen
        return view('livewire.ventas.registrar-ventas', [
            'clientes' => $clientes,
            'productos' => Producto::all(),
        ]);
    }
}
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

        if (!$producto) return;

        $subtotal = $precio * $cantidad;
        $ivaMonto = $subtotal * ($this->iva / 100);
        $descuentoMonto = $subtotal * ($this->descuento / 100);

        $total = $subtotal + $ivaMonto - $descuentoMonto;

        $this->detalle[] = [
            'producto_id' => $producto->id,
            'categoria' => $producto->categoria->nombre_categoria,
            'marca' => $producto->marca->nombreMarca,
            'nombre' => $producto->nombreProducto,
            'cantidad' => $cantidad,
            'precio_venta' => $precio,
            'subtotal' => $subtotal,
            'iva_monto' => $ivaMonto,
            'descuento_monto' => $descuentoMonto,
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
        $this->subtotal = collect($this->detalle)->sum('subtotal');

        $ivaCalculado = $this->subtotal * ($this->iva / 100);
        $descuentoCalculado = $this->subtotal * ($this->descuento / 100);
        $this->total = $this->subtotal + $ivaCalculado - $descuentoCalculado;
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

    public function guardarVenta()
    {
        $this->validate([
            'fecha' => 'required|date',
            'nventa' => 'required|integer',
            'cliente_id' => 'required|exists:clientes,id',
            'detalle' => 'required|array|min:1',
            'iva' => 'numeric|min:0|max:100',
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
            'iva.max' => 'El IVA no puede ser mayor a 100%.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede ser mayor a 100%.',
        ]);

        try {
            $user = Auth::user();

            $venta = Venta::create([
                'fecha' => $this->fecha,
                'nventa' => $this->nventa,
                'subtotal' => $this->subtotal,
                'iva' => $this->iva,
                'descuento' => $this->descuento,
                'total' => $this->total,
                'empleado_id' => $user->empleado->id ?? null,
                'cliente_id' => $this->cliente_id,
            ]);

            \Log::info('Venta creada correctamente: ', ['id' => $venta->id]);

            foreach ($this->detalle as $item) {
                DetalleVenta::create([
                    'venta_id' => $venta->id,
                    'producto_id' => $item['producto_id'],
                    'cantidad' => $item['cantidad'],
                    'precio_venta' => $item['precio_venta'],
                    'subtotal' => $item['subtotal'],
                    'iva_monto' => $item['iva_monto'],
                    'descuento_monto' => $item['descuento_monto'],
                    'total' => $item['total'],
                ]);

                $producto = Producto::find($item['producto_id']);
                if ($producto) {
                    $producto->decrement('cantidadstock', $item['cantidad']);
                }
            }

            session()->flash('success', '¡Venta registrada exitosamente y stock actualizado!');
            $this->inicializarFormulario();
        } catch (\Exception $e) {
            session()->flash('error', 'Ocurrió un error al registrar la venta: ' . $e->getMessage());
            \Log::error('Error al guardar venta: ' . $e->getMessage());
            dd($e);
        }
    }

    public function inicializarFormulario()
    {
        $this->fecha = Carbon::now()->toDateString();
        $this->nventa = Venta::max('id') + 1;
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
        return view('livewire.ventas.registrar-ventas', [
            'clientes' => Cliente::all(),
            'productos' => Producto::all(),
        ]);
    }
}
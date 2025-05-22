<?php
namespace App\Livewire\Compras;

use Livewire\Component;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RegistrarCompras extends Component
{
    public $fecha;
    public $ncompra;
    public $proveedor_id;

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
        $this->ncompra = Compra::max('id') + 1;
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
    $this->subtotal = collect($this->detalle)->sum('subtotal');

    $ivaCalculado = $this->subtotal * ($this->iva / 100);
    $descuentoCalculado = $this ->subtotal * ($this->descuento / 100);
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

        public function guardarCompra()
    {
        // 1. Validar los datos del formulario
        $this->validate([
            'fecha' => 'required|date',
            'ncompra' => 'required|integer',
            'proveedor_id' => 'required|exists:proveedores,id',
            'detalle' => 'required|array|min:1', // Debe haber al menos un producto en el detalle
            'iva' => 'numeric|min:0|max:100', // Tasa de IVA debe ser un porcentaje válido
            'descuento' => 'numeric|min:0|max:100', // Tasa de descuento debe ser un porcentaje válido
        ], [
            'fecha.required' => 'La fecha de la compra es obligatoria.',
            'ncompra.required' => 'El número de compra es obligatorio.',
            'ncompra.integer' => 'El número de compra debe ser un número entero.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
            'detalle.required' => 'Debe agregar al menos un producto a la compra.',
            'detalle.min' => 'Debe agregar al menos un producto a la compra.',
            'iva.numeric' => 'El IVA debe ser un número.',
            'iva.min' => 'El IVA no puede ser negativo.',
            'iva.max' => 'El IVA no puede ser mayor a 100%.',
            'descuento.numeric' => 'El descuento debe ser un número.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede ser mayor a 100%.',
        ]);

        try {
            // 2. Capturar el usuario loggeado
            $user = Auth::user();

            // 3. Crear el registro de la Compra principal
$compra = Compra::create([
    'fecha' => $this->fecha,
    'ncompra' => $this->ncompra,
    'subtotal' => $this->subtotal,
    'iva' => $this->iva,
    'descuento' => $this->descuento,
    'total' => $this->total,
    'fecha' => $this->fecha,
    'usuario_id' => $user->id,
    'empleado_id' => $user->empleado->id ?? null,
    'proveedor_id' => $this->proveedor_id,
]);




            // 4. Guardar los detalles de la compra y actualizar el stock
            foreach ($this->detalle as $item) {
DetalleCompra::create([
    'compra_id' => $compra->id,
    'producto_id' => $item['producto_id'],
    'cantidad' => $item['cantidad'],
    'precio_compra' => $item['precio'],
    'subtotal' => $item['subtotal'],
    'iva_monto' => $item['iva'],            
    'descuento_monto' => $item['descuento'],  
    'total' => $item['total'],             
]);


                // Actualiza el stock del producto
                $producto = Producto::find($item['producto_id']);
                if ($producto) {
                    $producto->increment('cantidadstock', $item['cantidad']);
                }
            }

            // 5. Reiniciar el formulario y mostrar mensaje de éxito
            session()->flash('success', '¡Compra registrada exitosamente y stock actualizado!');
            // Reinicia todas las propiedades a sus valores iniciales, excepto los datos maestros
            
        } catch (\Exception $e) {
            // 6. Manejo de errores
            session()->flash('error', 'Ocurrió un error al registrar la compra: ' . $e->getMessage());
               \Log::error('Error al guardar compra: ' . $e->getMessage());
    dd($e); // <- Esto te muestra exactamente el problema
    session()->flash('error', 'Ocurrió un error al registrar la compra: ' . $e->getMessage());
        }
      // dd("Se ha registrado la compra");
    }

        public function render()
    {
        return view('livewire.compras.registrar-compras', [
            'proveedores' => Proveedor::all(),
            'productos' => Producto::all(),
        ]);
    }
}

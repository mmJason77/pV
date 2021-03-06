<?php

    class connection{
        public $conn;


        function __construct(){
            $this->conn = new mysqli("localhost","root","Jesus8","puntoventalibreria");
            }
        }

    class Sistema extends  connection{
        public $categorias;
        public $productos;
        public $marca;
        public $proveedores;
        public $venta;
        public $detalleventa;
        
        
        function __construct(){
            
        }

        function deleteProducto($id){
            parent:: __construct();
            $query = "call deleteProducto($id)";
            $estadoDelete = $this->conn->query($query);
            $this->conn->close();
            return $estadoDelete;
        }

        
        function getProductosMarcaProveedor($idMarca, $idProveedor){
            parent:: __construct();
            $this->productos = $this->conn->query("call getProductosMarcaProveedor($idMarca, $idProveedor)");
            $this->conn->close();
        }
        function obtenerProductosMarcaProveedor(){
            if ($producto = $this->productos->fetch_assoc())
                return $producto;
            else
                return false;
        }
        function getProductosCategoriaProveedor($idCategoria, $idProveedor){
            parent:: __construct();
            $this->productos = $this->conn->query("call getProductosCategoriaProveedor($idCategoria, $idProveedor)");
            $this->conn->close();
        }

        function obtenerProductosCategoriaProveedor(){
            if ($productoCP = $this->productos->fetch_assoc())
                return $productoCP;
            else
                return false;
        }

        function consultarCategoriasIdNombre(){
            parent:: __construct();
            $this->categorias = $this->conn->query("SELECT idCategorias,categoriaNombre from categoria");
            $this->conn->close();
        }

        function obtenerCategoriasIdNombre(){
        if($categoria=$this->categorias->fetch_assoc())
            return $categoria;
        else
            return false;
        }

        function consultarMarcasIdNombre(){
            parent::__construct();
            $this->marcas = $this->conn->query("SELECT idMarcas,marcaNombre from marca");
            $this->conn->close();
        }

        function ObtenerMarcasIdNombre(){
            if($marcas=$this->marcas->fetch_assoc())
                return $marcas;
            else
                return false;
        }

        function consultarProveedoresIdNombre(){
            parent::__construct();
            $this->proveedores =$this->conn->query("SELECT idProveedores,proveedoresNombre from proveedores");
            $this->conn->close();
        }

        function obtenerProveedoresIdNombre(){
            if($proveedores=$this->proveedores->fetch_assoc())
                return $proveedores;
            else
                return false;
        }
        function consultarProductosCategoria($id){
            parent::__construct();
            $this->productos = $this->conn->query("SELECT *from producto where Categoria_idCategorias ='$id'");
            $this->conn->close();
        }   

        function obtenerProductosCategorias(){
            if($producto=$this->productos->fetch_assoc())
                    return $producto;
            else
                return false;
        }
        
        function consultarProductosMarcas($marca){
            parent::__construct();
            $this->marcas=$this->conn->query("SELECT *from Producto where Marca_IdMarcas ='$marca'");
            $this->conn->close();
        }

        function obtenerProductosMarcas(){
            if($marca=$this->marcas-> fetch_assoc()) 
                return $marca;
            else
                return false;
        }
        
        function consultarProductosProveedores($prov){
            parent::__construct();
            $this->proveedores=$this->conn->query("SELECT *from Producto where Proveedores_idProveedores = $prov");
            $this->conn->close();
        }

        function obtenerProductosProveedores(){
            if($proveedores=$this->proveedores->fetch_assoc())
                return $proveedores;
            else
                return false;
        }
        
        function consultarProductosCoincidencia($busqueda){
            parent::__construct();
            $this->producto=$this->conn->query("SELECT *from producto where ProductoDescripcion like '%$busqueda%'");
            $this->conn->close();
        }
        function obtenerProductosCoincidencia(){
            if($producto=$this->producto->fetch_assoc())
                return $producto;
            else
                return false;
        }
        function consultarProductos(){
            parent::__construct();
            $this->productos=$this->conn->query("SELECT * from producto");
            $this->conn->close();
        }
        function obtenerProductos(){
            if($producto=$this->productos->fetch_assoc())
                return $producto;
            else 
                return false;
        }
           
        function consultarMarcas(){
            parent::__construct();
            $this->marca=$this->conn->query("SELECT * from marca");
            $this->conn->close();
        }

        function obtenerMarcas(){
            if($marca=$this->marcas->fetch_assoc())
                return $marca;
            else
                return false;
        }

    
        function consultarProveedores(){
            parent::__construct();
            $this->proveedores=$this->conn->query("SELECT * from proveedores");
            $this->conn->close();
        }

        function ObtenerProveedores(){
            if ($proveedores = $this->proveedores->fetch_assoc())
                return $proveedores;
            else 
                return false;
        }

        function getProductos(){
            parent::__construct();
            $this->productos = $this->conn->query("call getProductos()");
            $this->conn->close();
        }
        
        function obtenerGetProductos(){
            if ($producto = $this->productos->fetch_assoc())
                return $producto;
            else 
                return false;
        }

        function consultarGetProductosCategoriasMarcas($idCategoria,$idMarca){
            parent::__construct();
            $this->productos=$this->conn->query("call getProductosCategoriaMarca($idCategoria,$idMarca)");
            $this->conn->close();
        }
        
        function obtenerGetProductosCategoriasMarca(){
            if($producto = $this->productos->fetch_assoc())
                    return $producto;
            else
                    return false;
        }

        function consultarGetCatMarProv($idCategoria,$idMarca,$idProveedor){
            parent::__construct();
            $this->productos=$this->conn->query("call getProductosCategoriaMarcaProveedor($idCategoria,$idMarca,$idProveedor)");
            $this->conn->close();
        }
 
        function obtenerGetCatMarProv(){
            if($producto = $this->productos->fetch_assoc())
                    return $producto;
            else
                      return false;
        }      
        
        function crearNuevoProducto($arrayProducto){
            $codigoProducto=$arrayProducto['codigoProducto'];
            $descripcionProducto=$arrayProducto['descripcionProducto'];
            $codCategoria=$arrayProducto['codigoCategoria'];
            if (is_string($codCategoria)) {
                parent::__construct();
                $query = "call setCategoriaNP('$codCategoria')";
                $idNCP = $this->conn->query($query);
                $this->conn->close();
                $id = $idNCP->fetch_assoc();
                $codCategoria = (int)$id['last_insert_id()'];
            }
            $codMarca=$arrayProducto['codigoMarca'];
            if (is_string($codMarca)) {
                parent::__construct();
                $query = "call setMarcaNP('$codMarca')";
                $idNCP = $this->conn->query($query);
                $this->conn->close();
                $id = $idNCP->fetch_assoc();
                $codMarca = (int)$id['last_insert_id()'];
            }
            $totalInicial=(int)$arrayProducto['totalInicial'];
            $precioCosto=(float)$arrayProducto['precioCosto'];
            $precioVenta=$arrayProducto['precioVenta'];
            $codProveedor=$arrayProducto['codigoProveedor'];
            if (is_string($codProveedor)) {
                parent::__construct();
                $query = "call setProveedorNP('$codProveedor')";
                $idNCP = $this->conn->query($query);
                $this->conn->close();
                $id = $idNCP->fetch_assoc();
                $codProveedor = (int)$id['last_insert_id()'];
            }
            $fecha = date("Y-m-d");
            $hora = date("G:i:s");
            $query= ("setNames utf8");
            parent:: __construct();
            $this->conn->query($query);
            $query = "call setNuevoProducto($codigoProducto, '$descripcionProducto', $codCategoria, $codMarca, $totalInicial, $precioCosto, $precioVenta, $codProveedor)";
            $this->productos = $this->conn->query($query);
            $this->conn->close();
            $productos = array();
            $filaProductos = $this->productos->fetch_assoc();
            $producto=array();
            foreach ($filaProductos as $key => $value) {
                $producto[$key] = $value;
            }
            array_unshift($productos,$producto);
            $idNuevoProducto = (int)$productos[0]['idProducto'];
            $query = "call setDetalleCompra('$descripcionProducto', $precioCosto, $codMarca, $codProveedor, $codCategoria, $totalInicial, '$fecha', '$hora', $idNuevoProducto)";
            parent:: __construct();
            if (!$this->conn->query($query)) {
                printf("Errormessage: %s\n", $this->conn->error);
            }
            $this->conn->close();

            return $productos;
        }


        function modificarNuevoProducto($arrayProducto){
            $descripcionProducto=$arrayProducto['descripcionProducto'];          
            $totalInicial=$arrayProducto['totalInicial'];
            $precioCosto=(float)$arrayProducto['precioCosto'];
            $precioVenta=$arrayProducto['precioVenta'];
            $codigoProductoo=(int)$arrayProducto['codigoProducto'];
            $fecha = date("Y-m-d");
            $hora = date("G:i:s");
            // Obtengo el Id de Marca
            parent:: __construct();
            $query = "SELECT M.idMarcas from marca M inner join detallecompra DC on M.idMarcas = DC.idMarcas inner join producto P on DC.Producto_idProducto = P.idProducto where P.idProducto = $codigoProductoo group by P.idProducto";
            if (!$codMarca = $this->conn->query($query)) {
                printf("Errormessage: %s\n", $this->conn->error);
            }
            $this->conn->close();
            $codMarca = $codMarca->fetch_assoc();
            $codMarca = (int)$codMarca['idMarcas'];

            // Obtengo el Id de Proveedor
            parent::__construct();
            $query = "SELECT P.idProveedores from proveedores P inner join detallecompra DC on P.idProveedores = DC.idProveedores inner join producto PR on DC.Producto_idProducto = PR.idProducto where PR.idProducto = $codigoProductoo group by PR.idProducto;";
            $codProveedor = $this->conn->query($query);
            $this->conn->close();
            $codProveedor = $codProveedor->fetch_assoc();
            $codProveedor = (int)$codProveedor['idProveedores'];
            // Obtengo el Id de Categoria
            parent::__construct();
            $query = "SELECT C.idCategorias from categoria C inner join detallecompra DC on C.idCategorias = DC.idCategorias inner join producto PR on DC.Producto_idProducto = PR.idProducto where PR.idProducto = $codigoProductoo group by PR.idProducto;";
            $codCategoria = $this->conn->query($query);
            $this->conn->close();
            $codCategoria = $codCategoria->fetch_assoc();
            $codCategoria = (int)$codCategoria['idCategorias'];
            
            // Modifico el producto en inventario
            $query = ("call setModificarProducto('$descripcionProducto',$totalInicial,$precioCosto,$precioVenta,$codigoProductoo)");
            parent:: __construct();
            $this->productos= $this->conn->query($query);
            $this->conn->close();

            // Si el usuario desea comprar mas de un producto existente
            if ($totalInicial > 0) {
                $query = "call setDetalleCompra('$descripcionProducto', $precioCosto, $codMarca, $codProveedor, $codCategoria, $totalInicial, '$fecha', '$hora', $codigoProductoo)";
                parent:: __construct();
                if (!$this->conn->query($query)) {
                    printf("Errormessage: %s\n", $this->conn->error);
                }
                $this->conn->close();
            }
        }  


        function obtenerModificarNuevoProducto(){
            if($producto = $this->productos->fetch_assoc())
                    return $producto;
           else
                     return false;
    }
     
    function concultarNuevaVenta($arrayVenta){
            $ventaDescripcion=$arrayVenta['ventaDescripcion'];          
            $ventaFecha=$arrayVenta['ventaFecha'];
            $ventaHora=$arrayVenta['ventaHora'];
            $VentaUsuario=$arrayVenta['ventaUsuario'];
            $cliente=$arrayVenta['cliente'];
            parent::__construct();
            $query = ("call nuevaVenta('$ventaDescripcion',$ventaFecha,$ventaHora,$ventaUsuario,$cliente)");
            $this->ventas= $this->conn->query($query);
            $this->conn->close();
            
        }  
        
        
        function obtenerNuevaVenta(){
            if($venta = $this->productos->fetch_assoc());
                    return $venta;

        }


        function consultarProductosCoincidenciaVenta($coincidencia){
            parent::__construct();
            $this->producto=$this->conn->query("SELECT P.idProducto, C.CategoriaNombre, P.ProductoDescripcion, M.marcaNombre, P.ProductocoPrecioVenta, P.ProductoExistencia from categoria C inner join producto P on C.idCategorias = P.Categoria_idCategorias inner join marca M on P.Marca_idMarcas = M.idMarcas where ProductoDescripcion like '%$coincidencia%'");
            $this->conn->close();
        }
        function obtenerProductosCoincidenciaVenta(){
            if($producto=$this->producto->fetch_assoc())
                return $producto;
            else
                return false;
        }
       
        function consultarGetProductosCategoriaMarcaVenta($catVenta,$imarcaVenta){
            parent::__construct();
            $this->productos=$this->conn->query("call getProductosCategoriaMarcaVenta($catVenta,$imarcaVenta)");
            $this->conn->close();
        }
        
        function obtenerGetProductosCategoriaMarcaVenta(){
            if($producto = $this->productos->fetch_assoc())
                    return $producto;
            else
                    return false;
        }

        function consultarGetProductoMarcaVenta($idMarca){
            parent::__construct();
            $this->productos=$this->conn->query("call getMarcasColumnas($idMarca)");
            $this->conn->close();
        }
 
        function obtenerProductoMarcaVenta(){
            if($producto = $this->productos->fetch_assoc())
                    return $producto;
            else
                      return false;
        }      

        function consultarGetProductosCategoriaVenta($idCategoria){
            parent::__construct();
            $this->productos=$this->conn->query("call getProductosCategoriaVenta($idCategoria)");
            $this->conn->close();
        }

        function obtenerProductoCategoriaVenta(){
            if($producto = $this->productos->fetch_assoc())
                    return $producto;
            else
                      return false;
        }     


        function consultarCoincidenciaCatMVenta($idCategoria,$idMarca,$coincidencias){
            parent::__construct();
            $this->producto=$this->conn->query("SELECT P.idProducto, C.CategoriaNombre, P.ProductoDescripcion, M.marcaNombre, P.ProductocoPrecioVenta, P.ProductoExistencia from categoria C inner join producto P on C.idCategorias = P.Categoria_idCategorias inner join marca M on P.Marca_idMarcas = M.idMarcas where idCategorias and idMarcas like '%$coincidencia%'");
            $this->conn->close();
        }
        function obtenerCoincidenciaCatMVenta(){
            if($producto=$this->producto->fetch_assoc())
                return $producto;
            else
                return false;
        }

        function crearVenta($descripcion,$fecha, $hora,$usuario,$idCliente){
        parent::__construct();
        $idProducto = $this->conn->query("call nuevaVenta('$descripcion','$fecha','$hora','$usuario',$idCliente)");
        $this->conn->close();  
      //  echo "$descripcion,$fecha,$hora,$usuario,2";

        if($idNuevoProducto = $idProducto->fetch_assoc())
                return $idNuevoProducto;
        else
                return false;
     }  


        function detalleVenta($cantidad,$idProductos,$idVentas){
            $tipoCantidad = (int)$cantidad;
            $tipoIdProducto = (int)$idProductos;
            $tipoIdVenta = (int)$idVentas;
            parent::__construct();
            $query = ("call getAlmacenaDetalle($tipoCantidad,$tipoIdProducto,$tipoIdVenta)");
            $this->productos= $this->conn->query($query);
            if ($this->productos) 
                echo "Detalle de venta almacenado exitosamente";
            else
                echo "Error al almacenar el detalle de venta";
            $this->conn->close();
            }

            function modificarProducto(){
            parent::__construct(); 
            $this->productos=$this->conn->query("update producto set productoExistencia=nuevaExistencia");
            if ($this->productos) 
                echo "Detalle de venta almacenado exitosamente";
            else
                echo "Error al almacenar el detalle de venta";
            $this->conn->close();
            
            }

            function modificarCategorias($arrayCategoria){
            $idCategoria=$arrayCategoria['idCategoria'];          
            $categoriaNombre=$arrayCategoria['categoriaNombre'];
            parent::__construct();
            $query = ("call setModificaCategoria($idCategoria,'categoriaNombre')");
            $this->categorias= $this->conn->query($query);
            $this->conn->close();
            
        }  
            function obtenerModificarNuevaCategoria(){
            if($categoria = $this->categorias->fetch_assoc())
                    return $categoria;
            else
                     return false;
            }
     

            function deleteCategoria($id){
            parent:: __construct();
            $query = ("deleteCategoria($id)");
            $estadoDelete = $this->conn->query($query);
            $this->conn->close();
            return $estadoDelete;
        }
/*
            function modificarProveedores($arrayProveedores){
            $idProveedores=$arrayProveedores['idProveedores'];          
            $ProveedoresNombre=$arrayProveedores['ProveedoresNombre'];
            parent::__construct();
            $query = ("()");
            $this->categorias= $this->conn->query($query);
            $this->conn->close();
            
        }  
            function obtenerNuevoProveedor(){
            if($Proveedores = $this->proveedores->fetch_assoc())
                    return $proveedores;
            else
                     return false;
            }

            function deleteProveedores($id){
            parent:: __construct();
            $query = ("deleteProveedores($id)");
            $estadoDelete = $this->conn->query($query);
            $this->conn->close();
            return $estadoDelete;
        }

            function modificarMarcas($arrayMarcas){
            $idMarcas=$arrayMarcas['idMarcas'];          
            $marcaNombre=$arrayMarcas['MarcaNombre'];
            parent::__construct();
            $query = ("()");
            $this->marcas= $this->conn->query($query);
            $this->conn->close();
            
        }  
            function obtenerNuevaMarca(){
            if($Marca= $this->marcas->fetch_assoc())
                    return $marcas;
            else
                     return false;
            }

            function deleteMarcas($id){
            parent:: __construct();
            $query = ("deleteMarcas($id)");
            $estadoDelete = $this->conn->query($query);
            $this->conn->close();
            return $estadoDelete;
        }

        */

















    }


      class Categoria extends connection{
        private $nombreCategoria;
        
        public $codigo;
        public $nom;
        public $descripcion;
        
        function __construct(){
            
        }
        
        function borrarCategoria(){
        
        }
        function crearNuevaCategoria(){
            
            
        }
        
    }

    class Producto extends connection{
        private $codigoProducto;
        
        public $codigo;
        public $descripcion;
        public $categoria;
        public $marca;
        public $total;
        public $precioCosto;
        public $precioVenta;
        public $proveedores;
        public $enlace;
        
        function __construct(){
            
        }
        
        function productoBorrarProducto(){
            
        }
        
        function productoCrearNuevoProducto(){
                }
   
    }
    
class Marca extends connection{
        private $marcaCodigo;
        
        public $codigo;
        public $nombre;
        public $observacion;
        public $enlace;
        
        function __construct(){     
       
        }
        function marcaBorrarMarca(){
            
        }
        function marcaCrearNuevaMarca(){
            
        }
    }

class Proveedores extends connection{
    private $proveedorNombre;
    
    public $nombre;
    public $nit;
    public $direccion;
    public $telefono;
    public $email;
    
    function __construct(){
        
    }
    function proveedorBorrarProveedor(){
        
    }
    function proveedorCrearNuevoProveedor(){
        
    }
}


/**
* Clase Producto
**/
/**
* 
*/

/*class ProductoP
{
    public $id;
    public $nombre;
    public $precioCosto;

    function __construct()
    {
        
    }

    function getId(){
        return $this->id;
    }
    function getMombre(){
        return $this->nombre;
    }
    function getPrecioCosto(){
        return $this->precioCosto;
    }

    function setId($id){
        $this->id = $id;
    }
    function setMombre($nombre){
        $this->nombre = $nombre;
    }
    function setPrecioCosto($precioCosto){
        $this->precioCosto = $precioCosto;
    }

    function saludar(){
        echo "Hola soy el producto $this->nombre";
    }
    function updateProducto(){
        echo "Me voy a actualizar, soy el pructo $this->nombre";
    }
*/
//}

?>








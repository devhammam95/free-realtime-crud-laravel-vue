
import home from "../HomeComponent.vue";
import IndexProducts from "../components/product/IndexProductsComponent";
import CreateProduct from "../components/product/CreateProductComponent";
import EditProduct from "../components/product/EditProductComponent";
import ShowProduct from "../components/product/ShowProductComponent";

const routes = [
    {component:home,path:'/','name':'home',meta:{title:'home'}},
    {component:IndexProducts,path:'/product','name':'product.index',meta:{title:'product'}},
    {component:CreateProduct,path:'/product/create','name':'product.create',meta:{title:'create a product'}},
    {component:EditProduct,path:'/product/:id/edit','name':'product.edit',meta:{title:'edit product data'}},
    {component:ShowProduct,path:'/product/:id','name':'product.show',meta:{title:'show a product data'}},
]
export default routes;

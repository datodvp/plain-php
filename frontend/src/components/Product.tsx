import { FC, useRef } from "react";
import { IProduct } from "../pages/List"

interface Props {
    product: IProduct,
}

const Product: FC<Props> = ({ product }) => {

    const checkbox = useRef<HTMLInputElement>(null);
    
    return (
        <div className=" min-w-48  h-40 flex flex-col justify-center items-center text-center border border-black rounded-md p-4 relative">
            <input ref={checkbox} value={product.id} type="checkbox" className="delete-checkbox absolute left-5 top-5 w-4 h-4"/>
            <p>{product.sku}</p>
            <p>{product.name}</p>
            <p>{product.price}</p>
            <p>{product.attribute}: {product.type_value} {product.measurement}</p>
        </div>
    )
}

export default Product
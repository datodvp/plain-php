import { FC, useRef } from "react";
import { IProduct } from "../pages/List"

interface Props {
    product: IProduct,
    addMassDeleteItem: (id: number) => void,
    removeMassDeleteItem: (id: number) => void
}

const Product: FC<Props> = ({ product, addMassDeleteItem, removeMassDeleteItem}) => {

    const checkbox = useRef<HTMLInputElement>(null);

    const handleClick = () => {
        if(checkbox.current) {
            checkbox.current.checked = !checkbox.current.checked;
        }

        if(checkbox.current?.checked) {
            addMassDeleteItem(product.id);
        } else if(!checkbox.current?.checked) {
            removeMassDeleteItem(product.id);
        }
    }
    
    return (
        <div onClick={handleClick} className="cursor-pointer min-w-48 hover:bg-slate-100 h-40 flex flex-col justify-center items-center text-center border border-black rounded-md p-4 relative">
            <input ref={checkbox} type="checkbox" style={{pointerEvents: 'none'}} className="absolute left-5 top-5 w-4 h-4"/>
            <p>{product.sku}</p>
            <p>{product.name}</p>
            <p>{product.price}</p>
            <p>{product.attribute}: {product.type_value}</p>
        </div>
    )
}

export default Product
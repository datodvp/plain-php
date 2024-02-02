import { useEffect, useState } from "react"
import axios from "axios"

interface Product {
    id: number,
    name: string,
    sku: string,
    price: number,
    type_value: string,
    type_name: string,
    attribute: string,
    measurement: string | null,
}

const List = () => {
    const [products, setProducts] = useState<Product[] | null>(null)

    useEffect(() => {
        axios.get('http://127.0.0.1:8000/api/products')
            .then(response => {
                // Handle response data
                setProducts(response.data)
            })
            .catch(error => {
                // Handle error
            });
    }, [])

  return (
    <div>
        {products?.map((product: Product) => {
            return <div className="bg-black">
                <p>{product.sku}</p>
                <p>{product.name}</p>
                <p>{product.price}</p>
                <p>{product.attribute}: {product.type_value}</p>
            </div>
        })}
    </div>
  )
}

export default List
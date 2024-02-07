import { useEffect, useRef, useState } from "react"
import axios from "axios"
import Product from "../components/Product"
import { Link } from "react-router-dom"
import Footer from "../components/Footer"

interface IApiResponse<T> {
    data: T,
    message: string
}

export interface IProduct {
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
    const [products, setProducts] = useState<IProduct[] | null>(null)
    const selectedIds = useRef<number[]>([])

    useEffect(() => {
        axios.get('http://127.0.0.1:8000/api/products')
            .then(response => {
                setProducts(response.data.data)
            })
    }, [])

    const addMassDeleteItem = (id: number) => {
        selectedIds.current.push(id)
    }

    const removeMassDeleteItem = (id: number) => {
        const indexOfId = selectedIds.current.indexOf(id);

        if(indexOfId > -1) {
            selectedIds.current.splice(indexOfId, 1);
        }
    }

    const deleteItems = () => {
        if(selectedIds.current.length)

        axios.post<IApiResponse<IProduct[]>>('http://127.0.0.1:8000/api/products/delete',
        {
            id_list: [...selectedIds.current]
        }).then((response) => {
            setProducts(response.data.data);
        })
    }

  return (<>
    <div className="flex flex-col justify-between h-screen">
        <div>
            <div className="border border-b-black p-8 flex justify-between items-center">
                <h1 className="text-4xl font-bold">Product List</h1>
                <div className="flex gap-4">
                    <Link to={'/add-product'} className="px-4  py-2 bg-blue-500 rounded-md cursor-pointer text-white hover:bg-blue-600">Add</Link>
                    <div onClick={deleteItems} className="px-4  py-2 bg-red-600 rounded-md cursor-pointer text-white hover:bg-red-700">Mass Delete</div>
                </div>
                
            </div>

            <div className="grid gap-6 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mx-auto w-fit p-10">
                {products?.map((product: IProduct) => {
                    return <div key={product.id}>
                                <Product product={product} 
                                        addMassDeleteItem={addMassDeleteItem} 
                                        removeMassDeleteItem={removeMassDeleteItem}
                                    />
                        </div>
                })}
            </div>
        </div>

        <Footer />
    </div>

    </>
  )
}

export default List
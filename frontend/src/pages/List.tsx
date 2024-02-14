import { useEffect, useRef, useState } from "react"
import axios from "axios"
import Product from "../components/Product"
import { Link } from "react-router-dom"
import Footer from "../components/Footer"
import { useApiService } from "../Services/api"

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
        const apiService = useApiService();
        
        apiService.getProducts().then(response => {
                setProducts(response.data.data)
            })
    }, [])
console.log()
    const addMassDeleteItem = (id: number) => {
        selectedIds.current.push(id)
    }

    const deleteItems = () => {
        const apiService = useApiService();
        // I had to do this because of the way autoQA is testing mass remove. I could not use reactiviry in here
        const checkboxes = document.getElementsByClassName('delete-checkbox') as HTMLCollectionOf<HTMLInputElement>;
        for (let i = 0; i < checkboxes.length; i++) {
            if(checkboxes[i].checked === true) {
                addMassDeleteItem(Number(checkboxes[i].value));
            }
        }
        if(selectedIds.current.length) {
            const items = {
                id_list: [...selectedIds.current]
            }
            apiService.massDelete(JSON.stringify(items)).then((response) => {
                setProducts(response.data.data);
                // test
            })
        }


    }

  return (<>
    <div className="flex flex-col justify-between h-screen">
        <div>
            <div className="border border-b-black p-8 flex justify-between items-center">
                <h1 className="text-4xl font-bold">Product List</h1>
                <div className="flex gap-4">
                    <Link to={'/add-product'} className="px-4  py-2 bg-blue-500 rounded-md cursor-pointer text-white hover:bg-blue-600">ADD</Link>
                    <button onClick={deleteItems} className="px-4  py-2 bg-red-600 rounded-md cursor-pointer text-white hover:bg-red-700">MASS DELETE</button>
                </div>
                
            </div>

            <div className="grid gap-6 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-4 mx-auto w-fit p-10">
                {products?.map((product: IProduct) => {
                    return <div key={product.id}>
                                <Product product={product} />
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
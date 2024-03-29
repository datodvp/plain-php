import { Link } from 'react-router-dom'
import Footer from '../components/Footer'
import { ChangeEvent, useEffect, useState } from 'react'
import BookInput from '../components/BookInput';
import DVDInput from '../components/DVDInput';
import FurnitureInput from '../components/FurnitureInput';
import axios, { AxiosError } from 'axios';
import { useNavigate } from 'react-router-dom';
import { useApiService } from '../Services/api';

export interface IPostBody {
    type_id: string,
    name: string,
    sku: string,
    price: string,
    weight?: string,
    size?: string
    width?: string
    height?: string
    length?: string
}

interface ISuccessResponse {
    type_id: string,
    name: string,
    sku: string,
    price: string,
    weight?: string,
    size?: string
    width?: string
    height?: string
    length?: string
}

export interface IErrorResponse {
    type_id: string,
    name: string,
    sku: string,
    price: string,
    weight?: string,
    size?: string
    width?: string
    height?: string
    length?: string
}

interface IApiResonse {
    data?: {
        product?: ISuccessResponse
        errors?: IErrorResponse,
    },
    message: string
}

const AddProduct = () => {
    const BOOK = 1;
    const DVD = 2;
    const Furniture = 3;
    const navigate = useNavigate();
    const [currentType, setCurrentType] = useState<any>(null);
    const [errors, setErrors] = useState<IErrorResponse>();
    const [newItem, setNewItem] = useState<IPostBody>({
        "type_id": "",
        "name": "",
        "sku": "",
        "price": "",
    })

    useEffect(() => {
        function switchBody() {
            if(currentType == BOOK) {
                setNewItem({
                    "type_id": newItem.type_id,
                    "name": newItem.name,
                    "sku": newItem.sku,
                    "price": newItem.price,
                    "weight": ""
                })
            }
            if(currentType == DVD) {
                setNewItem({
                    "type_id": newItem.type_id,
                    "name": newItem.name,
                    "sku": newItem.sku,
                    "price": newItem.price,
                    "size": ""
                })
            }

            if(currentType == Furniture) {
                setNewItem({
                    "type_id": newItem.type_id,
                    "name": newItem.name,
                    "sku": newItem.sku,
                    "price": newItem.price,
                    "width": "",
                    "height": "",
                    "length": ""
                })
            }
        }

        switchBody();
    }, [currentType])

    const addItem = () => {
        const apiService = useApiService();
        apiService.addProduct(JSON.stringify(newItem))
        .then(() => {
            navigate('/');
        })
        .catch((error: AxiosError<IApiResonse>) => {
            setErrors(error.response?.data.data?.errors);
        })
    }

    const handleInputChange = (event: ChangeEvent<HTMLInputElement>) => {
        setNewItem({
            ...newItem,
            [event.target.name]: event.target.value
        })
    }
    
    const changeType = (event: ChangeEvent<HTMLSelectElement>) => {
        setCurrentType(event.target.value);
        
        setNewItem({
            ...newItem,
            type_id: event.target.value
        })
        
        if(Number(event.target.value) === BOOK) {
            setCurrentType(BOOK);
        } else if(Number(event.target.value) === DVD) {
            setCurrentType(DVD);
        } else if(Number(event.target.value) === Furniture) {
            setCurrentType(Furniture);
        }
    }
  return (
    <>
    <div className="flex flex-col h-full">
        <div className="border border-b-black p-8 flex justify-between items-center">
            <h1 className="text-4xl font-bold">Product Add</h1>
            <div className="flex gap-4">
                <button onClick={addItem} className="px-4  py-2 bg-blue-500 rounded-md cursor-pointer text-white hover:bg-blue-600">Save</button>
                <Link to={'/'}  className="px-4  py-2 bg-red-600 rounded-md cursor-pointer text-white hover:bg-red-700">Cancel</Link>
            </div>
            
        </div>
        <div className="grid gap-6 sm:grid-cols-1 h-full ml-10% w-fit p-10">
            <form id='product_form' className='flex flex-col gap-5'>
                <div className='flex flex-col'>
            
                    <div className='flex flex-col w-[270px] gap-3'>   
                        <div className='flex   justify-between'>
                            <label htmlFor="sku" className='p-[5px]'>SKU:</label>
                            <div className='flex flex-col'>
                                <input id="sku" type="text" name='sku' value={newItem.sku} onChange={handleInputChange} className='border p-[5px]' />
                                <span className='text-sm text-red-500'>{errors?.sku}</span>
                            </div>
                        </div>
                        <div className='flex   justify-between'>
                            <label htmlFor="name" className='p-[5px]'>Name:</label>
                            <div className='flex flex-col '>
                              <input id="name" type="text" name='name' value={newItem.name} onChange={handleInputChange} className='border p-[5px]' />
                              <span className='text-sm text-red-500'>{errors?.name}</span>
                            </div>

                        </div>
                        <div className='flex  justify-between'>
                            <label htmlFor="price" className='p-[5px]'>price:</label>
                            <div className='flex flex-col'>
                                <input id="price" type="text" name='price' value={newItem.price} onChange={handleInputChange} className='border p-[5px]' />
                                <span className='text-sm text-red-500'>{errors?.price}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div className='flex gap-5'>
                        <label htmlFor="select">Type Switcher</label>
                        <select id="productType" onChange={changeType} name="type_value" defaultValue="" className='border'>
                            <option value="" disabled>Select Type</option>
                            <option value="1">Book</option>
                            <option value="2">DVD</option>
                            <option value="3">Furniture</option>
                        </select>
                    </div>
                    <div className='text-sm text-red-500'>{errors?.type_id}</div>
                </div>

                {currentType === BOOK ? <BookInput value={newItem.weight} errors={errors} handleInputChange={handleInputChange} /> : 
                currentType === DVD ? <DVDInput value={newItem.size} errors={errors} handleInputChange={handleInputChange} /> :
                currentType === Furniture && <FurnitureInput value={newItem} errors={errors} handleInputChange={handleInputChange} />}
            </form>
        </div>
        <Footer />
    </div>
    </>
  )
}

export default AddProduct
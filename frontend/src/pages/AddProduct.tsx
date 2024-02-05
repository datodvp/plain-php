import { Link } from 'react-router-dom'
import Footer from '../components/Footer'
import { ChangeEvent, useState } from 'react'
import BookInput from '../components/BookInput';
import DVDInput from '../components/DVDInput';
import FurnitureInput from '../components/FurnitureInput';
import axios from 'axios';

const AddProduct = () => {
    const BOOK = 1;
    const DVD = 2;
    const Furniture = 3;
    const [currentType, setCurrentType] = useState<any>(null);
    const [newItem, setNewItem] = useState({
        "type_id": "",
        "name": "",
        "sku": "",
        "price": "",
    })

    const addItem = () => {
        axios.post('http://127.0.0.1:8000/api/products', newItem)
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
                <div onClick={addItem} className="px-4  py-2 bg-blue-500 rounded-md cursor-pointer text-white hover:bg-blue-600">Save</div>
                <Link to={'/'}  className="px-4  py-2 bg-red-600 rounded-md cursor-pointer text-white hover:bg-red-700">Cancel</Link>
            </div>
            
        </div>
        <div className="grid gap-6 sm:grid-cols-1 h-full ml-10% w-fit p-10">
            <div className='flex flex-col gap-5'>
                <div className='flex'>
                    <div className='flex flex-col'>
                        <label htmlFor="sku" className='p-[5px] m-1'>SKU:</label>
                        <label htmlFor="name" className='p-[5px] m-1'>Name:</label>
                        <label htmlFor="price" className='p-[5px] m-1'>price:</label>
                    </div>
                    <div className='flex flex-col'>
                        <input type="text" name='sku' value={newItem.sku} onChange={handleInputChange} id='sku' className='border p-[5px] m-1' />
                        <input type="text" name='name' value={newItem.name} onChange={handleInputChange} id='name' className='border p-[5px] m-1' />
                        <input type="text" name='price' value={newItem.price} onChange={handleInputChange} id='price' className='border p-[5px] m-1' />
                    </div>
                </div>

                <div className='flex gap-5'>
                    <label htmlFor="select">Type Switcher</label>
                    <select onChange={changeType} name="type_value" id="select" defaultValue="" className='border'>
                        <option value="" disabled>Select Type</option>
                        <option value="1">Book</option>
                        <option value="2">DVD</option>
                        <option value="3">Furniture</option>
                    </select>
                </div>
                {currentType === BOOK ? <BookInput /> : 
                currentType === DVD ? <DVDInput /> :
                currentType === Furniture && <FurnitureInput />}
            </div>
        </div>
        <Footer />
    </div>
    </>
  )
}

export default AddProduct
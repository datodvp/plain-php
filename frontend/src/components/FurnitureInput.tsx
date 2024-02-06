import { ChangeEvent } from "react"
import { IPostBody } from "../pages/AddProduct"

type Props = {
  value: IPostBody,
  handleInputChange: (event: ChangeEvent<HTMLInputElement>) => void
}

const FurnitureInput = (props: Props) => {
  return (
    <div className='flex'>
        <div className='flex flex-col'>
            <label htmlFor="height" className='p-[5px] m-1'>Height (CM):</label>
            <label htmlFor="width" className='p-[5px] m-1'>Width (CM):</label>
            <label htmlFor="length" className='p-[5px] m-1'>length (CM):</label>
        </div>
        <div className='flex flex-col'>
            <input type="text" name='height' id='height' value={props.value.height} onChange={props.handleInputChange} className='border p-[5px] m-1' />
            <input type="text" name='width' id='width' value={props.value.weight} onChange={props.handleInputChange} className='border p-[5px] m-1' />
            <input type="text" name='length' id='length' value={props.value.length} onChange={props.handleInputChange} className='border p-[5px] m-1' />
        </div>
    </div>
  )
}

export default FurnitureInput
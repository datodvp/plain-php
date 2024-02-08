import { ChangeEvent } from 'react'
import { IErrorResponse } from "../pages/AddProduct"

type Props = {
  value: string | undefined,
  handleInputChange: (event: ChangeEvent<HTMLInputElement>) => void,
  errors: IErrorResponse | undefined
}


const DVDInput = (props: Props) => {
  const { errors } = props;
  return (
    <div className='flex justify-between w-[325px]'>
        <label htmlFor="size" className='p-[5px] m-1'>Size (MB):</label>
        <div className='flex flex-col'>
          <input type="text" name='size' value={props.value} onChange={props.handleInputChange} id='size' className='border p-[5px] m-1' />
          <span className='text-sm text-red-500'>{errors?.size}</span>
        </div>
    </div>
  )
}

export default DVDInput
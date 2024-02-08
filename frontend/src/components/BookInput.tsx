import { ChangeEvent } from "react"
import { IErrorResponse } from "../pages/AddProduct"

type Props = {
  value: string | undefined,
  handleInputChange: (event: ChangeEvent<HTMLInputElement>) => void,
  errors: IErrorResponse | undefined
}

const BookInput = (props: Props) => {
  const { errors } = props;
  return (
    <div className='flex justify-between w-[325px]'>
        <label htmlFor="weight" className='p-[5px] m-1'>Weight (KG):</label>
        <div className='flex flex-col'>
            <input type="text" name='weight' value={props.value} onChange={props.handleInputChange} id='weight' className='border p-[5px] m-1' />
            <span className='text-sm text-red-500'>{errors?.weight}</span>
        </div>
    </div>
  )
}

export default BookInput
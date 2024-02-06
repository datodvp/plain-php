import { ChangeEvent } from "react"

type Props = {
  value: string | undefined,
  handleInputChange: (event: ChangeEvent<HTMLInputElement>) => void
}

const BookInput = (props: Props) => {
  return (
    <div className='flex'>
        <div className='flex flex-col'>
            <label htmlFor="weight" className='p-[5px] m-1'>Weight (KG):</label>
        </div>
        <div className='flex flex-col'>
            <input type="text" name='weight' value={props.value} onChange={props.handleInputChange} id='weight' className='border p-[5px] m-1' />
        </div>
    </div>
  )
}

export default BookInput
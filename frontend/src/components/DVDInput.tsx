import { ChangeEvent } from 'react'

type Props = {
  value: string | undefined,
  handleInputChange: (event: ChangeEvent<HTMLInputElement>) => void
}

const DVDInput = (props: Props) => {
  return (
    <div className='flex'>
        <div className='flex flex-col'>
            <label htmlFor="size" className='p-[5px] m-1'>Size (MB):</label>
        </div>
        <div className='flex flex-col'>
          <input type="text" name='size' value={props.value} onChange={props.handleInputChange} id='size' className='border p-[5px] m-1' />
        </div>
    </div>
  )
}

export default DVDInput
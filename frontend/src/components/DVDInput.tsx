import React from 'react'

type Props = {}

const DVDInput = (props: Props) => {
  return (
    <div className='flex'>
        <div className='flex flex-col'>
            <label htmlFor="size" className='p-[5px] m-1'>Size (MB):</label>
        </div>
        <div className='flex flex-col'>
            <input type="text" name='size' id='size' className='border p-[5px] m-1' />
        </div>
    </div>
  )
}

export default DVDInput
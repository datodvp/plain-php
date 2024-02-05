type Props = {}

const FurnitureInput = (props: Props) => {
  return (
    <div className='flex'>
        <div className='flex flex-col'>
            <label htmlFor="height" className='p-[5px] m-1'>Height (CM):</label>
            <label htmlFor="width" className='p-[5px] m-1'>Width (CM):</label>
            <label htmlFor="length" className='p-[5px] m-1'>length (CM):</label>
        </div>
        <div className='flex flex-col'>
            <input type="text" name='height' id='height' className='border p-[5px] m-1' />
            <input type="text" name='width' id='width' className='border p-[5px] m-1' />
            <input type="text" name='length' id='length' className='border p-[5px] m-1' />
        </div>
    </div>
  )
}

export default FurnitureInput
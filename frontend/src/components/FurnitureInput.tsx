import { ChangeEvent } from "react"
import { IPostBody, IErrorResponse } from "../pages/AddProduct"

type Props = {
  value: IPostBody,
  handleInputChange: (event: ChangeEvent<HTMLInputElement>) => void,
  errors: IErrorResponse | undefined
}

const FurnitureInput = (props: Props) => {
  const { errors } = props;
  return (<>
  <div className='flex flex-col w-[325px] gap-3'>   
      <div className='flex   justify-between'>
          <label htmlFor="height" className='p-[5px] m-1'>Height (CM):</label>
          <div className='flex flex-col'>
              <input type="text" name='height' id='height' value={props.value.height} onChange={props.handleInputChange} className='border p-[5px] m-1' />
              <span className='text-sm text-red-500'>{errors?.height}</span>
          </div>
      </div>
      <div className='flex   justify-between'>
          <label htmlFor="width" className='p-[5px] m-1'>Width (CM):</label>
          <div className='flex flex-col '>
            <input type="text" name='width' id='width' value={props.value.weight} onChange={props.handleInputChange} className='border p-[5px] m-1' />
            <span className='text-sm text-red-500'>{errors?.width}</span>
          </div>

      </div>
      <div className='flex  justify-between'>
          <label htmlFor="length" className='p-[5px] m-1'>length (CM):</label>
          <div className='flex flex-col'>
              <input type="text" name='length' id='length' value={props.value.length} onChange={props.handleInputChange} className='border p-[5px] m-1' />
              <span className='text-sm text-red-500'>{errors?.length}</span>
          </div>
      </div>
  </div>
  </>
    
    

  )
}

export default FurnitureInput
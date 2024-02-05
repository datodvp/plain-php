import { createRoot } from "react-dom/client";
import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";
import List from "./pages/List";
import './index.css'
import AddProduct from "./pages/AddProduct";

const router = createBrowserRouter([
  {
    path: "/",
    element: <List />,
  },
  {
    path: "add-product",
    element: <AddProduct />,
  },
]);

createRoot(document.getElementById("root") as HTMLDivElement).render(
  <RouterProvider router={router} />
);
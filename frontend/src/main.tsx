import { createRoot } from "react-dom/client";
import {
  createBrowserRouter,
  RouterProvider,
} from "react-router-dom";
import List from "./pages/List";
import './index.css'

const router = createBrowserRouter([
  {
    path: "/",
    element: <List />,
  },
  {
    path: "add-product",
    element: <div>add product</div>,
  },
]);

createRoot(document.getElementById("root") as HTMLDivElement).render(
  <RouterProvider router={router} />
);
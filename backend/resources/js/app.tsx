import './bootstrap';
import { createRoot } from "react-dom/client";
import Exemplo from "./components/teste";

const container = document.getElementById("app");
if (container) {
    const root = createRoot(container);
    root.render(<Exemplo />);
}

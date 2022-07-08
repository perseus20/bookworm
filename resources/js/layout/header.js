import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import { Link, Routes, Route } from "react-router-dom";
import Navbar from "react-bootstrap/Navbar";
import HomePage from "./../components/homepage";
import ShopPage from "./../components/shoppage";
import CartPage from "./../components/Cartpage";
import Product from "./../components/product";

export default function Header() {
    return (
        <>
            <Navbar collapseOnSelect expand="lg" bg="dark" variant="dark">
                <Container>
                    <Navbar.Brand href="/">BOOKWORM</Navbar.Brand>
                    <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                    <Navbar.Collapse
                        id="responsive-navbar-nav"
                        className="justify-content-end"
                    >
                        <Nav>
                            <Link to="/" className="nav-link">
                                Home
                            </Link>
                            <Link to="shop" className="nav-link">
                                Shop
                            </Link>
                            <Link to="about" className="nav-link">
                                About
                            </Link>
                            <Link to="cart" className="nav-link">
                                Cart
                            </Link>
                            <Link to="login" className="nav-link">
                                Login
                            </Link>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
            <Routes>
                <Route path="/" element={<HomePage />} />
                <Route path="shop" element={<ShopPage />} />
                <Route path="/product/:id" element={<Product />} />
            </Routes>
        </>
    );
}

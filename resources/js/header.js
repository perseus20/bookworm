import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";

function CollapsibleExample() {
    return (
        <Navbar collapseOnSelect expand="lg" bg="dark" variant="dark">
            <Container>
                <Navbar.Brand href="#home">BOOKWORM</Navbar.Brand>
                <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                <Navbar.Collapse
                    id="responsive-navbar-nav"
                    className="justify-content-end"
                >
                    <Nav>
                        <Nav.Link href="#home">Home</Nav.Link>
                        <Nav.Link href="#shop">Shop</Nav.Link>
                        <Nav.Link href="#about">About</Nav.Link>
                        <Nav.Link href="#cart">Cart</Nav.Link>
                        <Nav.Link href="#login">Login</Nav.Link>
                    </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar>
    );
}

export default CollapsibleExample;

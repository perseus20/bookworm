import React from "react";
import GetOnSale from "./getonsale";
import Header from "./header";
import Button from "react-bootstrap/Button";
import Container from "react-bootstrap/Container";
import Nav from "react-bootstrap/Nav";
import Navbar from "react-bootstrap/Navbar";
import ButtonGroup from "react-bootstrap/ButtonGroup";
export default function HomePage() {
    return (
        <>
            <Header />
            <Navbar collapseOnSelect expand="lg" bg="light" variant="dark">
                <Container>
                    <Navbar.Text id="onsale">
                        <h3>On Sale</h3>
                    </Navbar.Text>
                    <Navbar.Toggle aria-controls="responsive-navbar-nav" />
                    <Navbar.Collapse className="justify-content-end">
                        <Nav>
                            <Button variant="outline-success">View all</Button>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>
            <div id="getonsale">
                <GetOnSale />
            </div>
            <div className="center1">
                <h3>Featured Books</h3>
                <div>
                    <ButtonGroup aria-label="Basic example">
                        <Button variant="secondary">Recommended</Button>
                        <Button variant="secondary">Popular</Button>
                    </ButtonGroup>
                </div>
            </div>
        </>
    );
}

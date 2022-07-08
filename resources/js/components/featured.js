import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import axios from "axios";
import { useState, useEffect } from "react";
import Button from "react-bootstrap/Button";
import Cardd from "./cardd";
// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";

export default function Featured() {
    const [books, setBooks] = useState([]);
    const [urld, setUrld] = useState(
        `http://localhost:8000/api/books/get-recommended`
    );
    const handleRecommended = () => {
        setUrld(`http://localhost:8000/api/books/get-recommended`);
    };
    const handlePopular = () => {
        setUrld(`http://localhost:8000/api/books/get-popular`);
    };
    useEffect(() => {
        axios
            .get(urld)
            .then((res) => {
                setBooks(res.data.data);
            })
            .catch((error) => console.log(error));
    }, [urld]);
    return (
        <>
            <Container>
                <div className="text-center mt-4 mb-4">
                    <h3>Featured Books</h3>
                    <Button variant="primary" onClick={handleRecommended}>
                        Recommended
                    </Button>
                    <Button variant="primary" onClick={handlePopular}>
                        Popular
                    </Button>
                </div>
            </Container>
            <Container>
                <Row>
                    {books.map((book) => (
                        <Col md={3} key={book.id}>
                            <Cardd book={book} />
                        </Col>
                    ))}
                </Row>
            </Container>
        </>
    );
}

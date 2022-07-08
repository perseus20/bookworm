import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import { Link } from "react-router-dom";
import Card from "react-bootstrap/Card";

// Import Swiper styles
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/scrollbar";

export default function Cardd(props) {
    const book = props.book;
    var footer;
    var img;
    if (book.attributes.book_cover) {
        img = book.attributes.book_cover;
    } else {
        img = "default";
    }
    if (book.attributes.book_price == book.attributes.book_final_price) {
        footer = (
            <Card.Footer className="text-muted bold">
                <span className="bold">${book.attributes.book_price}</span>
            </Card.Footer>
        );
    } else {
        footer = (
            <Card.Footer className="text-muted">
                <del>${book.attributes.book_price}</del>{" "}
                <span className="bold">
                    ${book.attributes.book_final_price}
                </span>
            </Card.Footer>
        );
    }
    return (
        <>
            <Link
                to={`/product/${book.id}`}
                params={{ testvalue: "hello" }}
                className="nav-link"
            >
                <Card className="dcard">
                    <Container fluid="md">
                        <Row>
                            <Col>
                                <Card.Img
                                    width={250}
                                    height={250}
                                    variant="top"
                                    src={`http://localhost:8000/images/${img}.jpg`}
                                />
                            </Col>
                        </Row>
                        <Row>
                            <Col>
                                <Card.Body>
                                    <Card.Text className="bold">
                                        {book.attributes.book_title.length > 25
                                            ? `${book.attributes.book_title.substring(
                                                  0,
                                                  25
                                              )}...`
                                            : book.attributes.book_title}
                                    </Card.Text>
                                    <Card.Text>
                                        {
                                            book.attributes.book_author
                                                .author_name
                                        }
                                    </Card.Text>
                                </Card.Body>
                            </Col>
                        </Row>
                    </Container>
                    <Card.Footer className="text-muted">{footer}</Card.Footer>
                </Card>
            </Link>
        </>
    );
}

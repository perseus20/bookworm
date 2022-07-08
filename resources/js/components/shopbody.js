import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import axios from "axios";
import Pagination from "react-js-pagination";
import { Link, Routes, Route } from "react-router-dom";
import { useState, useEffect } from "react";
import Cardd from "./cardd";

export default function ShopBody(props) {
    const [books, setBooks] = useState([]);
    const [metas, setMetas] = useState([]);
    const [tests, setTests] = useState([]);
    const sort = props.sort;
    const category = props.category;
    const author = props.author;
    const star = props.star;
    const perPage = props.perPage;
    var link = "";
    if (sort == 1) {
        link = `get-sort-by-on-sale?category=${category}&author=${author}&star=${star}&perPage=${perPage}`;
    }
    if (sort == 2) {
        link = `get-sort-by-popular?category=${category}&author=${author}&star=${star}&perPage=${perPage}`;
    }
    if (sort == 3) {
        link = `get-sort-by-final-price-asc?category=${category}&author=${author}&star=${star}&perPage=${perPage}`;
    }
    if (sort == 4) {
        link = `get-sort-by-final-price-desc?category=${category}&author=${author}&star=${star}&perPage=${perPage}`;
    }
    const [urld, setUrld] = useState(`http://localhost:8000/api/books/${link}`);
    const handlePageChange = (p) => {
        setUrld(`http://localhost:8000/api/books/${link}&page=${p}`);
    };
    useEffect(() => {
        setUrld(`http://localhost:8000/api/books/${link}`);
    }, [link]);
    console.log(urld);
    useEffect(() => {
        axios
            .get(urld)
            .then((res) => {
                setBooks(res.data.data);
                setMetas(res.data.meta);
                setTests(res.data.links);
            })
            .catch((error) => console.log(error));
    }, [urld]);
    return (
        <>
            <Container>
                <Row>
                    <Col className="text-end mt-4 mb-4"></Col>
                </Row>
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
            <Container>
                <div className="text-center mt-4 mb-4">
                    <Pagination
                        itemClass="page-item"
                        linkClass="page-link"
                        firstPageText="First"
                        lastPageText="Last"
                        activePage={metas.current_page}
                        itemsCountPerPage={metas.per_page}
                        totalItemsCount={metas.total}
                        pageRangeDisplayed={20}
                        onChange={(pageNumber) => handlePageChange(pageNumber)}
                    />
                </div>
            </Container>
        </>
    );
}

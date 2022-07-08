import React from "react";
import Container from "react-bootstrap/Container";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import ShopHeader from "./shopheader";
import { useState, useEffect } from "react";
import ShopBody from "./shopbody";
import Category from "./shopcategory";
import Author from "./shopauthor";
import Navbar from "react-bootstrap/Navbar";

export default function ShopPage() {
    const [sort, setSort] = useState("1");
    const [perPage, setPerPage] = useState("12");
    const [category, setCategory] = useState("0");
    const [author, setAuthor] = useState("0");
    const [star, setStar] = useState("0");
    const handleSort = (data) => {
        setSort(data);
    };
    const handlePaginate = (e) => {
        setPerPage(event.target.value);
    };
    const handleCategory = (cate) => {
        setCategory(cate);
    };
    const handleAuthor = (author) => {
        setAuthor(author);
    };
    const handleStar = (e) => {
        setStar(event.target.value);
    };
    return (
        <>
            <Navbar>
                <Container>
                    <h3>Books</h3>
                </Container>
            </Navbar>
            <Container>
                <div className="w-50 mt-4 mb-4">
                    <div>
                        <ShopHeader parentCallback={handleSort} />
                        <div>
                            <p>Paginate</p>
                            <select
                                className="form-select w-50"
                                aria-label="Default select example"
                                onChange={handlePaginate}
                            >
                                <option value="5">Show 5</option>
                                <option value="15">Show 15</option>
                                <option value="20">Show 20</option>
                                <option value="25">Show 25</option>
                            </select>
                        </div>
                    </div>
                </div>
            </Container>
            <Container>
                <Row>
                    <Col className="mt-4 mb-4">
                        <p>Fill by category</p>
                        <Category parentCallback={handleCategory} />
                    </Col>
                    <Col className="mt-4 mb-4">
                        <p>Fill by author</p>
                        <Author parentCallback={handleAuthor} />
                    </Col>
                    <Col className="mt-4 mb-4">
                        <div className="mt-4 mb-4">
                            <p>Fill by star</p>
                            <select
                                className="form-select w-50"
                                aria-label="Default select example"
                                onChange={handleStar}
                            >
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </Col>
                </Row>
            </Container>
            <ShopBody
                sort={sort}
                perPage={perPage}
                category={category}
                author={author}
                star={star}
            />
        </>
    );
}

import React, { Component } from 'react';
import axios from 'axios';

import Form from "./Form.jsx";
import List from "./List.jsx";
import Menu from "../Template/Menu.jsx";
import PageHeader from "../Template/PageHeader.jsx";

const apiUrl = 'http://localhost/todo-app/backend/';

export default class Todo extends Component {

    constructor(props) {
        super(props);
        this.state = {description: '', list: []};

        this.handleAdd    = this.handleAdd.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleRemove = this.handleRemove.bind(this);

        this.refresh();
    }


    refresh() {
        axios.get(apiUrl)
            .then((response) => {
                this.setState({...this.state, description: '', list: response.data.tasks});
            });
    }


    handleChange(e) {
        this.setState({...this.state, description: e.target.value});        
    }


    handleAdd() {
        let data = new FormData();
        data.append("description", this.state.description);

        axios.post(apiUrl, data)
            .then((response) => {
                this.refresh();
            });
    }


    handleRemove(id) {
        axios.delete(apiUrl + id + '/delete')
            .then((response) => {
                this.refresh();
            });
    }


    render() {
        return (
            <div>
                <Menu />
                <div className="container">
                    <PageHeader name="Tarefas" small="Cadastro" />

                    <Form 
                        description={this.state.description}
                        handleChange={this.handleChange}
                        handleAdd={this.handleAdd}
                    />

                    <List 
                        tasks={this.state.list} 
                        remove={this.handleRemove}
                    />
                </div>
            </div>
        );
    }
}
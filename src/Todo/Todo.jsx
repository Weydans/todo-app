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

        this.handleAdd           = this.handleAdd.bind(this);
        this.handleClear         = this.handleClear.bind(this);
        this.handleChange        = this.handleChange.bind(this);
        this.handleSearch        = this.handleSearch.bind(this);
        this.handleRemove        = this.handleRemove.bind(this);
        this.handleMarkAsDone    = this.handleMarkAsDone.bind(this);
        this.handleMarkAsPending = this.handleMarkAsPending.bind(this);

        this.refresh();
    }


    refresh(description = '') {
        let url = description ? apiUrl + '?search=' + description : apiUrl;

        axios.get(url)
            .then((response) => {
                this.setState({...this.state, description, list: response.data.tasks});
            });
    }


    handleSearch() {
        this.refresh(this.state.description);
    }


    handleClear() {
        this.refresh();
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


    handleMarkAsDone(task) {
        let formData = new FormData();
        let data     = { ...task, done: 'S' };

        for (let key in data) {
            formData.append(key, data[key]);
        }

        axios.post(apiUrl + 'update/' + task.id, formData)
            .then((response) => this.refresh(this.state.description));
    }


    handleMarkAsPending(task) {
        let formData = new FormData();
        let data     = { ...task, done: 'N' };

        for (let key in data) {
            formData.append(key, data[key]);
        }

        axios.post(apiUrl + 'update/' + task.id, formData)
            .then((response) => this.refresh(this.state.description));
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
                        handleSearch={ this.handleSearch }
                        handleClear={ this.handleClear }
                    />

                    <List 
                        tasks={this.state.list} 
                        remove={this.handleRemove}
                        markAsDone={this.handleMarkAsDone}
                        markAsPending={this.handleMarkAsPending}
                    />
                </div>
            </div>
        );
    }
}
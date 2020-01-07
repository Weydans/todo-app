import React from 'react';
import { Link } from 'react-router-dom';

export default props => (
    <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
        <div className="container">
            <Link to='/'>
                <span className="navbar-brand">Todo</span>
            </Link>
            
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
            </button>

            <div className="col-sm-12 col-lg-2">
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav">
                        <Link to='/todo'>
                            <li className="nav-item">
                                <span className="nav-link">Tarefas</span>
                            </li>
                        </Link>
                        <Link to='/sobre'>
                            <li className="nav-item">
                                <span className="nav-link">Sobre</span>
                            </li>
                        </Link>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
);
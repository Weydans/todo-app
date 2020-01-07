import React from 'react';

import PageHeader from "../Template/PageHeader.jsx";
import Menu from '../Template/Menu.jsx';

export default (props) => (
    <div>
        <Menu />
        <div className="container">
            <PageHeader name="Sobre" small="Nós"/>
            
            <div className="row">
                <div className="col-12 border p-4 rounded">
                    <h4>Texto de exemplo</h4>
                    <p>Apenas para preencher espaço e ter algum tipo de conteúdo.</p>

                    <h4>Motivo</h4>
                    <p>Esta página é meramente ilustrativa.</p>

                    <h4>Coclusão</h4>
                    <p>Não serve para nada.</p>
                </div>
            </div>
        </div>
    </div>
);


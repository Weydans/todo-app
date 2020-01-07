import React from 'react';

const PageHeader = (props) => (
    <div className="row">
        <div className="col-12 py-2 mt-3">
            <header>
                <h2>{props.name} <small className="h5 text-muted">{props.small}</small></h2>
            </header>
        </div>
    </div>
);

export default PageHeader;
import React from 'react';

const Form = (props) => {
    const handleKey = (e) => {
        if (e.key === 'Enter') {
            e.ctrlKey ? props.handleSearch() : props.handleAdd();
        } else if (e.key === 'Escape') {
            props.handleClear();
        }
    };

    return (
        <form onSubmit={(e) => e.preventDefault()}>
            <div className="row mb-4">
                <div className="col-sm-12 col-lg-10 form-group">
                    <input 
                        className="form-control form-control-sm" 
                        type="text" 
                        name="tarefa" 
                        placeholder="Informe a tarefa" 
                        autoFocus
                        value={props.description}
                        onChange={props.handleChange}
                        onKeyUp={handleKey}
                    />
                </div>
    
                <div className="col-sm-12 col-lg-2 form-group">
                    <button type="button" 
                            className="btn btn-sm btn-primary border mr-2"
                            onClick={props.handleAdd}>
                        <i className="fa fa-save"></i>
                    </button>
    
                    <button type="button" 
                            className="btn btn-sm btn-info border mr-2"
                            onClick={ props.handleSearch }>
                        <i className="fa fa-search"></i>
                    </button>
    
                    <button type="button" 
                            className="btn btn-sm btn-danger border mr-2"
                            onClick={ props.handleClear }>
                        <i className="fa fa-close"></i>
                    </button>                
                </div>
            </div>
        </form>
    );
}

export default Form;
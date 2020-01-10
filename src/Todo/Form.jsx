import React from 'react';

const Form = (props) => (
    <form>
        <div className="row border-bottom">
            <div className="col-sm-12 col-lg-10 form-group">
                <input 
                    className="form-control form-control-sm" 
                    type="text" 
                    name="tarefa" 
                    placeholder="Informe a tarefa" 
                    autoFocus
                    value={props.description}
                    onChange={props.handleChange}
                />
            </div>

            <div className="col-sm-12 col-lg-2 form-group">
                <button type="button" 
                        className="btn btn-sm btn-primary mr-2"
                        onClick={props.handleAdd}>
                    <i className="fa fa-save"></i>
                </button>

                <button type="button" 
                        className="btn btn-sm border mr-2"
                        onClick={ props.handleSearch }>
                    <i className="fa fa-search"></i>
                </button>

                <button type="button" 
                        className="btn btn-sm btn-danger mr-2"
                        onClick={ props.handleClear }>
                    <i className="fa fa-trash"></i>
                </button>                
            </div>
        </div>
    </form>
);

export default Form;
import React from 'react';

import '../Template/coustom.css';

const List = (props) => {
    
    const renderRows = () => {
        const tasks = props.tasks || [];

        return tasks.map((task) => {
            let visible = (task.done === 'S') ? true : false;

            return (
                <tr key={task.id}>
                    <td>{task.id}</td>
                    <td className={ (task.done === 'S') ? 'marked-as-done' : '' }>{task.description}</td>
                    <td>
                        <button type="button" 
                                onClick={ () => props.markAsDone(task) }
                                className={`btn btn-sm btn-success mr-2 text-white`}
                                hidden={visible}
                        >
                            <i className="fa fa-check"></i>
                        </button>

                        <button type="button" 
                                onClick={ () => props.markAsPending(task) }
                                className={`btn btn-sm btn-warning mr-2 text-white`}
                                hidden={!visible}
                        >
                            <i className="fa fa-edit"></i>
                        </button>

                        <button type="button" 
                                onClick={ () => props.remove(task.id) }
                                className="btn btn-sm btn-danger mr-2 text-white"
                                hidden={!visible}
                        >
                            <i className="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            );
        });
    }

    return (
        <div className="row mt-5">
            <div className="col-12">
                <table className="table table-sm">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {renderRows()}
                    </tbody>
                </table>
            </div>
        </div>
    );
}

export default List;
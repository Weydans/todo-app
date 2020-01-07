import React from 'react';
import { BrowserRouter, Route, Redirect, Switch } from 'react-router-dom';

import Todo   from '../Todo/Todo.jsx';
import About  from '../About/About.jsx';

const Routes = () => (
    <BrowserRouter>
        <Switch>
            <Route exact path="/"      component={Todo} />
            <Route exact path="/todo"  component={Todo} />
            <Route exact path="/sobre" component={About} />
            <Redirect from="*" to="/" />
        </Switch>
    </BrowserRouter>
);

export default Routes;
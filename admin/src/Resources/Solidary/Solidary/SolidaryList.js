import React from 'react';

import { List, Datagrid, TextField, ShowButton } from 'react-admin';

export const SolidaryList = (props) => (
  <List {...props} title="Demandes solidaires > liste" perPage={25}>
    <Datagrid>
      <TextField source="subject.label" label="Objet" />
      <ShowButton />
    </Datagrid>
  </List>
);
import React from 'react';

import {
  Show,
  TabbedShowLayout,
  TextField,
  BooleanField,
  ReferenceField,
  SelectField,
  ReferenceArrayField,
  SingleFieldList,
  ChipField,
  NumberField,
  RichTextField,
  FunctionField,
  Tab,
} from 'react-admin';

import { addressRenderer } from '../../../utils/renderers';

const statusChoices = [
  { id: 0, name: 'En attente' },
  { id: 1, name: 'Actif' },
  { id: 2, name: 'Inactif' },
];

const RelayPointShow = (props) => {
  return (
    <Show {...props} title="Points relais > afficher">
      <TabbedShowLayout>
        <Tab label="Identité">
          <TextField source="name" label="Nom" />
          <ReferenceField source="address" label="Adresse" reference="addresses" linkType="">
            <FunctionField render={addressRenderer} />
          </ReferenceField>
          <SelectField source="status" label="Status" choices={statusChoices} />
          <ReferenceArrayField
            source="relayPointTypes"
            label="Types"
            reference="relay_point_types"
            allowEmpty
          >
            <SingleFieldList>
              <ChipField source="name" />
            </SingleFieldList>
          </ReferenceArrayField>
          <TextField source="description" label="Description" />
          <RichTextField source="fullDescription" label="Description complète" />
        </Tab>

        <Tab label="Communauté">
          <ReferenceField source="community" label="Communauté" reference="communities" allowEmpty>
            <TextField source="name" />
          </ReferenceField>
          <BooleanField source="private" label="Privé à cette communauté" />
        </Tab>

        <Tab label="Propriétés">
          <NumberField source="places" label="Nombre de places" />
          <NumberField source="placesDisabled" label="Nombre de places handicapés" />
          <BooleanField source="free" label="Gratuit" />
          <BooleanField source="secured" label="Sécurisé" />
          <BooleanField source="official" label="Officiel" />
          <BooleanField source="suggested" label="Suggestion autocomplétion" />
        </Tab>
      </TabbedShowLayout>
    </Show>
  );
};

export default RelayPointShow;
import React from 'react';
import { FormDataConsumer } from 'react-admin';
import { useForm } from 'react-final-form';

import ImageUpload from '../../../components/media/ImageUpload';

const RelayPointImageUpload = (props) => {
  const form = useForm();
  const label = props.label;

  return (
    <FormDataConsumer>
      {(formDataProps) => {
        return (
          <ImageUpload
            imageId={formDataProps.formData.images && formDataProps.formData.images[0]}
            onChange={(image) => image.id && form.change('images', ['/images/' + image.id])}
            referenceField="relayPoint"
            referenceId={formDataProps.formData.originId}
            label={label}
          />
        );
      }}
    </FormDataConsumer>
  );
};

export default RelayPointImageUpload;
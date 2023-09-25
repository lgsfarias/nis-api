'use client';

import { useState } from 'react';
import Button from './Button';

type Props = {
  onSubmit: (name: string) => Promise<void>;
};

const CitizenForm: React.FC<Props> = ({ onSubmit }) => {
  const [name, setName] = useState('');
  const [loading, setLoading] = useState(false);

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    onSubmit(name).finally(() => {
      setLoading(false);
      setName('');
    });
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="my-4 flex space-x-4">
        <input
          type="text"
          className="flex-auto border p-2 rounded"
          placeholder="Nome"
          value={name}
          onChange={(e) => setName(e.target.value)}
          required
        />
        <Button
          type="submit"
          loading={loading}
        >
          Cadastrar
        </Button>
      </div>
    </form>
  );
};

export default CitizenForm;

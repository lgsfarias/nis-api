'use client';

import { useState } from 'react';

type Props = {
  onSubmit: (name: string) => void;
};

const CitizenForm: React.FC<Props> = ({ onSubmit }) => {
  const [name, setName] = useState('');

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    onSubmit(name);
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
        <button className="uppercase font-semibold tracking-wider px-4 py-2 rounded text-white bg-blue-600">
          Cadastrar
        </button>
      </div>
    </form>
  );
};

export default CitizenForm;

'use client';

import { formatNIS } from '@/utils/nisUtils';
import { useState } from 'react';

type Props = {
  onSearch: (nis: string) => void;
};

const SearchNISForm: React.FC<Props> = ({ onSearch }) => {
  const [displayNis, setDisplayNIS] = useState('');

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setDisplayNIS(formatNIS(e.target.value));
  }

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const rawNis = displayNis.replace(/\D/g, '');
    onSearch(rawNis);
  };

  return (
    <form onSubmit={handleSubmit}>
      <div className="my-4 flex space-x-4">
        <input
          type="text"
          className="flex-auto border p-2 rounded"
          placeholder="NIS (somente números)"
          value={displayNis}
          onChange={(e) => handleChange(e)}
          required
        />
        <button className="uppercase font-semibold tracking-wider px-4 py-2 rounded text-white bg-blue-600">
          Pesquisar
        </button>
      </div>
    </form>
  );
};

export default SearchNISForm;

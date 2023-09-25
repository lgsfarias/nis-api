'use client';

import { formatNIS } from '@/utils/nisUtils';
import { useState } from 'react';
import Button from './Button';

type Props = {
  onSearch: (nis: string) => Promise<void>;
};

const SearchNISForm: React.FC<Props> = ({ onSearch }) => {
  const [displayNis, setDisplayNIS] = useState('');
  const [loading, setLoading] = useState(false);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setDisplayNIS(formatNIS(e.target.value));
  }

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    const rawNis = displayNis.replace(/\D/g, '');
    onSearch(rawNis).finally(() => {
      setLoading(false);
      setDisplayNIS('');
    });
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
        <Button
          type="submit"
          loading={loading}
        >
          Buscar
        </Button>
      </div>
    </form>
  );
};

export default SearchNISForm;

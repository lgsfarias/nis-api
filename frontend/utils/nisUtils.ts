/**
 * Formats the given value into a NIS format (NNN.NNNNN.NN-N)
 * @param value - A string value representing the raw NIS number
 * @returns A string in the NIS format
 */
export const formatNIS = (value: string): string => {
  // Remove non-numeric characters
  const numericValue = value.replace(/\D/g, '');

  // Apply the mask to the numeric value
  const parts = [
      numericValue.substring(0, 3),
      numericValue.substring(3, 8),
      numericValue.substring(8, 10),
      numericValue.substring(10, 11)
  ];

  const formatted = parts
      .filter(part => part.length > 0)
      .join('.');

  return formatted.replace(/\.(\d{2})\.(\d{1})$/, '.$1-$2');
};
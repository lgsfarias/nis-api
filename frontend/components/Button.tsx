type Props = {
  type: "submit" | "button";
  loading?: boolean;
  children: React.ReactNode;
};

const Button: React.FC<Props> = ({ type, loading, children }) => {
  return (
    <button
      type={type}
      className="flex items-center justify-center uppercase font-semibold tracking-wider px-4 py-2 rounded text-white bg-blue-600 hover:bg-blue-700 transition duration-200 w-[150px]"
      disabled={loading}
    >
      {loading
        ? <svg className="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></svg>
        : children}
    </button>
  );
};

export default Button;
<?php

namespace Epubli\Process;

use Symfony\Component\Process\Process;

interface ProcessBuilderInterface
{
    /**
     * @param string $prefix The path where to find the executable.
     */
    public function __construct($prefix);

    /**
     * @return Process
     */
    public function getProcess();

    /**
     * Set the path to the input file.
     *
     * @param string $path path to input file
     * @return $this
     */
    public function setInputFile($path);

    /**
     * Set input to stdin.
     *
     * @return $this
     */
    public function setInputStdin();

    /**
     * Set input data.
     *
     * @param string $input byte string handled as input stream/file
     * @return $this
     */
    public function setInput($input);

    /**
     * Set the path to the output file.
     *
     * @param string $path path to output file
     * @return $this
     */
    public function setOutputFile($path);

    /**
     * Set stdout as output.
     *
     * @return $this
     */
    public function setOutputStdout();
}
